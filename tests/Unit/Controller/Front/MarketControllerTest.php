<?php

namespace App\Tests\Unit\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MarketControllerTest extends WebTestCase
{
    public function testAccessMarketWithoutEmail()
    {
        $client = static::createClient(
            []
        );
        $client->request('GET', '/market/');
        $this->assertEquals(400,
            $client->getResponse()->getStatusCode(),
            "Le code retour devrait être 400"
        );
    }
}
