<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RouteTest extends WebTestCase
{
     /**
    * @dataProvider routeProvider
    */

    public function testPictureController(string $route): void
    {
        $client = static::createClient();
        $client->request('GET', $route);

        $this->assertResponseIsSuccessful();
    }

    public function routeProvider(): \Generator
    {
        yield ['/picture/'];
        yield ['/picture/new'];
        yield ['/picture/1'];
        yield ['/picture/1/edit'];
    }
}
