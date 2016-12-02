<?php

namespace Miviskin\AzovskyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RateControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/rate');

        $this->assertContains('USDRUB', $client->getResponse()->getContent());
    }
}
