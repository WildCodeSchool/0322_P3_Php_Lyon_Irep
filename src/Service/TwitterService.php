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

    public function authenticate(string $clientId, string $clientSecret, string $code, string $redirectUri): ?array
    {
        $response = $this->client->request('POST', '2/oauth2/token', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
            ],
            'form_params' => [
                'code' => $code,
                'grant_type' => 'authorization_code',
                'client_id' => $clientId,
                'redirect_uri' => $redirectUri,
                'code_verifier' => 'challenge',
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents(), true);
        }

        return null;
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
