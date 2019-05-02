<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BookingControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testBookingIsUp()
    {

        $this->client->request('GET', '/booking');

        static::assertSame(
            200,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testBookingForm()
    {
        $crawler = $this->client->request('GET', '/booking');

        $form = $crawler->selectButton('Valider le paiement')->form();
        $values = array(
            'ticketDate'             => '30-04-2020',
            'type]'                  =>'0',
            'tickets' => array (
                1 => array(
                    'firstName'      => 'Jean',
                    'lastName'       => 'Dupont',
                    'country'        => 'FR',
                    'birthDate'      => '06-02-1985',
                ),
            ),
            'email'                  => 'jean.dupont@gmail.com',
        );

       $this->client->request($form->getMethod(), $form->getUri(), $values);

    }
}