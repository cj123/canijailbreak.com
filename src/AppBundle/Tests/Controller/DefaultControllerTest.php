<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testHelp()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/help');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testJailbreaksJSON()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/jailbreaks.json');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('application/json', $client->getResponse()->headers->get('Content-Type'));
        $this->assertNotEmpty($client->getResponse()->getContent());
    }
}
