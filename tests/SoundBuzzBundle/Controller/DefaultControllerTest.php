<?php

// tests/SoundBuzzBundle/Controller/DefaultControllerTest.php
namespace Tests\SoundBuzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains(htmlentities("Nouvelles&nbsp;musiques"), $client->getResponse()->getContent());
        $this->assertContains('Genres', $client->getResponse()->getContent());
    }
}
