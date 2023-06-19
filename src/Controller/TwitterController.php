<?php

namespace App\Controller;

use App\Service\TwitterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwitterController extends AbstractController
{
    private TwitterService $twitterService;

    public function __construct(TwitterService $twitterService)
    {
        $this->twitterService = $twitterService;
    }

    #[Route('/tweet/{username}', name: 'get_tweet')]
    public function getTweet(string $username): Response
    {
        $tweet = $this->twitterService->getTweet($username);

        if (isset($tweet->text)) {
            return $this->render('Twitter/index.html.twig', ['tweet' => $tweet->text]);
        } else {
            // replace 'error' with a more descriptive error message
            return $this->render('Twitter/index.html.twig', ['tweet' => 'Erreur : ' . print_r($tweet, true)]);
        }
    }
}
