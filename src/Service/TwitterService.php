<?php

namespace App\Service;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterService
{
    private TwitterOAuth $connection;

    public function __construct(
        string $consumerKey,
        string $consumerSecret,
        string $accessToken,
        string $accessTokenSecret
    ) {
        $this->connection = new TwitterOAuth(
            $consumerKey,
            $consumerSecret,
            $accessToken,
            $accessTokenSecret
        );
    }

    public function getTweet(string $username): object
    {
        $tweets = $this->connection->get("statuses/user_timeline", ["screen_name" => $username, "count" => 1]);

        if ($this->connection->getLastHttpCode() == 200) {
            return $tweets[0];
        } else {
            // Handle error case
            return $tweets;
        }
    }
}
