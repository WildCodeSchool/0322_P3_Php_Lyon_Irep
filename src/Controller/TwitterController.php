<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use App\Service\TwitterService;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TwitterController extends AbstractController
{
    private Client $client;
    private RequestStack $requestStack;
    private TwitterService $twitterService;
    private PictureRepository $pictureRepository;

    public function __construct(
        RequestStack $requestStack,
        TwitterService $twitterService,
        PictureRepository $pictureRepository
    ) {
        $this->client = new Client([
            'base_uri' => 'https://api.twitter.com/',
        ]);
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

        $response = $this->client->request('POST', '2/oauth2/token', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
            ],
            'form_params' => [
                'code' => $code,
                'grant_type' => 'authorization_code',
                'client_id' => $clientId,
                'redirect_uri' => $twitterUri,
                'code_verifier' => 'challenge',
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody()->getContents(), true);
            $accessToken = $responseData['access_token'];

            $session->set('access_token', $accessToken);

            return $this->redirectToRoute('twitter');
        }

        return $this->render('twitter/callback.html.twig');
    }

    #[Route('/twitter/tweet/', name: 'twitter_tweet')]
    public function tweet(Request $request): Response
    {
        $hashtags = $request->query->get('hashtags', 'test');
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $accessToken = $session->get('access_token');

        if ($this->twitterService->tweet($accessToken, $hashtags)) {
            return new Response('ENFIN CA MARCHE');
        }

        return $this->redirectToRoute('twitter_callback');
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


        // Récupérer les hashtags du formulaire
        $hashtags = $request->request->get('hashtags');

        $session = $this->requestStack->getCurrentRequest()->getSession();
        $accessToken = $session->get('access_token');

        if ($accessToken === null || $accessToken === '') {
            return $this->redirect('https://twitter.com/i/oauth2/authorize?response_type=code&client_id='
            . $clientId . 'Q&redirect_uri='
            . $twitterUri .
            '&scope=tweet.read%20users.read%20tweet.write%20offline.access&state='
            . 'state&code_challenge=challenge&code_challenge_method=plain');
        }

        if ($this->twitterService->tweet($accessToken, $hashtags)) {
            $this->addFlash('notice', 'Le tweet a été publié avec succès');
            return $this->redirectToRoute('app_picture_show', ['id' => $id]);
        }

        return $this->redirectToRoute('twitter_callback');
    }


    #[Route('/twitter/tweet/preview/{id}', name: 'twitter_preview')]
    public function previewTweet(int $id): Response
    {
        $picture = $this->pictureRepository->find($id);

        if (!$picture) {
            throw $this->createNotFoundException('Aucune image trouvée pour cet id : ' . $id);
        }

        $hashtags = $picture->getLink();

        // passer les hashtags à la vue
        return $this->render('twitter/preview.html.twig', [
        'picture' => $picture,
        'hashtags' => $hashtags,
        ]);
    }
}
