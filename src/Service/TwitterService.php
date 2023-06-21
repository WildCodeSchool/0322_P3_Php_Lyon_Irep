<?php

namespace App\Service;

use GuzzleHttp\Client;

class TwitterService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.twitter.com/',
        ]);
    }

    public function tweet(string $accessToken, string $hashtags): bool
    {
        $response = $this->client->request('POST', '2/tweets', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'text' => $hashtags,
            ]),
        ]);

        return $response->getStatusCode() === 201;
    }
}
