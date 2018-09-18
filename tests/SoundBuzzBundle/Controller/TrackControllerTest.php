<?php

// tests/SoundBuzzBundle/Controller/TrackControllerTest.php
namespace Tests\SoundBuzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tracks');

//        $link = $crawler->filter('li.nav-item')->eq(2);
        $link = 'Ma ghjk';
        $this->assertContains('Ma', $link);

//        $this->assertGreaterThan(
//            0,
//            $crawler->filter('html:contains("Hello World")')->count()
//        );
    }
}
