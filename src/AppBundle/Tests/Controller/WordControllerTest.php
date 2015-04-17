<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WordControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Create');
    }

    public function testWord()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Word');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Delete');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Update');
    }

    public function testVote()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Vote');
    }

}
