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

    #[Route('/twitter', name: 'twitter')]
    public function index(): Response
    {
        return $this->render('twitter/index.html.twig');
    }

    #[Route('/twitter/callback', name: 'twitter_callback')]
    public function callback(SessionInterface $session): Response
    {
        $clientId = $_ENV['TWITTER_CLIENT_ID'];
        $clientSecret = $_ENV['TWITTER_CLIENT_SECRET'];
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
                'redirect_uri' => 'https://61a9-90-63-160-23.ngrok-free.app/twitter/callback',
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

    #[Route('/twitter/tweet/hashtags/{id}', name: 'twitter_hashtag')]
    public function tweetHashtags(int $id): Response
    {
        $picture = $this->pictureRepository->find($id);

        if (!$picture) {
            throw $this->createNotFoundException('Aucune image trouvée pour cet id : ' . $id);
        }

        $hashtags = $picture->getLink();

        $session = $this->requestStack->getCurrentRequest()->getSession();
        $accessToken = $session->get('access_token');

        if ($this->twitterService->tweet($accessToken, $hashtags)) {
            return new Response('ENFIN CA MARCHE');
        }

        return $this->redirectToRoute('twitter_callback');
    }
}
