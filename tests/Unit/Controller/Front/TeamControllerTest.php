<?php

namespace App\Tests\Unit\Controller\Front;

use App\Tests\Constant\Constant as ConstantTU;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    public function testListUsers()
    {
        $client = static::createClient(
            []
        );
        $client->request('GET', '/home');
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode(),
            "Le code retour devrait être 200"
        );
    }

    public function testSetEmail()
    {
        $client = static::createClient();
        $body = ConstantTU::getInfoAuthenticate(ConstantTU::USER);
        $client->request(
            'POST',
            '/set-email',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT'  => 'application/json',
            ],
            json_encode($body)
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAccessCreateTeamWithoutEmail()
    {
        $client = static::createClient();
        $client->request('GET', '/create-team');
        $this->assertEquals(
            400,
            $client->getResponse()->getStatusCode(),
            "Le code retour devrait être 400"
        );
    }

    public function testCreateTeam()
    {
        // Set email
        $client = self::login();

        $client->request('GET', '/create-team');
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode(),
            "Le code retour devrait être 200"
        );

        $body = [
            'name'         => 'team 100',
            'country'      => 'Angleterre',
            'moneyBalance' => 15000000.00,
            'owner'        => ConstantTU::USER,
        ];
        $client->request(
            'POST',
            '/create-team',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT'  => 'application/json',
            ],
            json_encode($body)
        );
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode(),
            "Le code retour devrait être 200"
        );
    }

    public static function login($username = ConstantTU::USER): KernelBrowser
    {
        $client = static::createClient();
        $body = ConstantTU::getInfoAuthenticate($username);
        $client->request(
            'POST',
            '/set-email',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT'  => 'application/json',
            ],
            json_encode($body)
        );

        self::ensureKernelShutdown();

        return $client;
    }
}
