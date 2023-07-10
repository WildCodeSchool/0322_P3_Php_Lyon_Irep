<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use App\Service\TwitterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TwitterController extends AbstractController
{
    private RequestStack $requestStack;
    private TwitterService $twitterService;
    private PictureRepository $pictureRepository;

    public function __construct(
        RequestStack $requestStack,
        TwitterService $twitterService,
        PictureRepository $pictureRepository
    ) {

        $this->requestStack = $requestStack;
        $this->twitterService = $twitterService;
        $this->pictureRepository = $pictureRepository;
    }

    #[Route('/twitter/callback', name: 'twitter_callback')]
    public function callback(SessionInterface $session): Response
    {
        $clientId = $_ENV['TWITTER_CLIENT_ID'];
        $clientSecret = $_ENV['TWITTER_CLIENT_SECRET'];
        $twitterUri = $_ENV['TWITTER_REDIRECT_URI'];
        $request = $this->requestStack->getCurrentRequest();
        $code = $request->get('code');

        $responseData = $this->twitterService->authenticate($clientId, $clientSecret, $code, $twitterUri);

        if ($responseData !== null) {
            $accessToken = $responseData['access_token'];

            $session->set('access_token', $accessToken);
            $id = $session->get('picture_id');

            return $this->redirectToRoute('app_picture_show', ['id' => $id]);
        }

        return $this->render('home/index.html.twig');
    }

    #[Route('/twitter/tweet/hashtags/{id}', name: 'twitter_hashtag', methods: ['POST'])]
    public function tweetHashtags(int $id, SessionInterface $session, Request $request): Response
    {
        $picture = $this->pictureRepository->find($id);
        $clientId = $_ENV['TWITTER_CLIENT_ID'];
        $twitterUri = $_ENV['TWITTER_REDIRECT_URI'];
        $session = $request->getSession();

        if (!$picture) {
            throw $this->createNotFoundException('Aucune image trouvée pour cet id : ' . $id);
        }

        $hashtags = $request->request->get('hashtags');
        $urlPage = $request->request->get('urlPage');

        $client = new Client();
        $response = $client->request('GET', 'http://tinyurl.com/api-create.php?url=' . urlencode($urlPage));
        $shortenedUrl = $response->getBody()->getContents();


        $comments = $request->request->get('comments');
        $tweet = $hashtags . ' ' .  $shortenedUrl . ' ' . $comments;
        $accessToken = $session->get('access_token');
        $session->set('picture_id', $id);

        if ($accessToken === null || $accessToken === '') {
            return $this->redirect('https://twitter.com/i/oauth2/authorize?response_type=code&client_id='
            . $clientId . '&redirect_uri=' . $twitterUri .
            '&scope=tweet.read%20users.read%20tweet.write%20offline.access&state=' .
            'state&code_challenge=challenge&code_challenge_method=plain');
        }

        try {
            if ($this->twitterService->tweet($accessToken, $tweet)) {
                $this->addFlash('notice', 'Le tweet a été publié avec succès');
                return $this->redirectToRoute('app_picture_show', ['id' => $id]);
            }
        } catch (ClientException $e) {
            if ($e->getCode() === 401) {
                $session->remove('access_token');
                return $this->redirect('https://twitter.com/i/oauth2/authorize?response_type=code&client_id='
                . $clientId . '&redirect_uri=' . $twitterUri .
                '&scope=tweet.read%20users.read%20tweet.write%20offline.access&state=' .
                'state&code_challenge=challenge&code_challenge_method=plain');
            }
            throw $e;
        }
        return $this->redirectToRoute('twitter_callback');
    }

    #[Route('/twitter/tweet/preview/{id}', name: 'twitter_preview')]
    public function previewTweet(int $id, Request $request): Response
    {
        $picture = $this->pictureRepository->find($id);

        if (!$picture) {
            throw $this->createNotFoundException('Aucune image trouvée pour cet id : ' . $id);
        }
        $hashtags = $picture->getLink();
        $urlPage = $request->getSchemeAndHttpHost() . $this->generateUrl('app_picture_show', ['id' => $id]);

        return $this->render('twitter/preview.html.twig', [
        'picture' => $picture,
        'hashtags' => $hashtags,
        'urlPage' => $urlPage,
        ]);
    }
    #[Route('/twitter/authenticate/{id}', name: 'twitter_authenticate')]
    public function authenticate(SessionInterface $session, Request $request, int $id): Response
    {
        $picture = $this->pictureRepository->find($id);
        $session = $request->getSession();
        $accessToken = $session->get('access_token');
        $clientId = $_ENV['TWITTER_CLIENT_ID'];
        $twitterUri = $_ENV['TWITTER_REDIRECT_URI'];
        if (!$picture) {
            throw $this->createNotFoundException('Aucune image trouvée pour cet id : ' . $id);
        }
        $session->set('picture_id', $id);


        try {
            if ($accessToken === null || $accessToken === '') {
                return $this->redirect('https://twitter.com/i/oauth2/authorize?response_type=code&client_id='
                    . $clientId . '&redirect_uri=' . $twitterUri .
                    '&scope=tweet.read%20users.read%20tweet.write%20offline.access&state=' .
                    'state&code_challenge=challenge&code_challenge_method=plain');
            }

            return $this->redirectToRoute('app_picture_show', ['id' => $id]);
        } catch (ClientException $e) {
            if ($e->getCode() === 401) {
                $session->remove('access_token');
                return $this->redirect('https://twitter.com/i/oauth2/authorize?response_type=code&client_id='
                    . $clientId . '&redirect_uri=' . $twitterUri .
                    '&scope=tweet.read%20users.read%20tweet.write%20offline.access&state=' .
                    'state&code_challenge=challenge&code_challenge_method=plain');
            }
            throw $e;
        }
    }
}
