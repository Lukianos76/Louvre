<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testHomeIsUp()
    {
        $this->client->request('GET', '/');

        static::assertSame(
            200,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testHome()
    {
        $crawler = $this->client->request('GET', '/');

        static::assertSame(
            1,
            $crawler->filter('html:contains("Bienvenue sur la billeterie du Louvre !")')->count()
        );
    }
}