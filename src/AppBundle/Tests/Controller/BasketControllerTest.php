<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BasketControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/koszyk');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/koszyk/{id}/dodaj');
    }

    public function testRemove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/koszyk/{id}/usun');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/koszyk/{id}/zaktualizuj-ilosc/{quantity}');
    }

    public function testClear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/koszyk/wyczysc');
    }

    public function testBuy()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/koszyk/kup');
    }

}
