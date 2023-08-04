<?php

namespace App\Tests\Controllers;

use ApiTestCase\JsonApiTestCase;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class UserControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function testGetHelloWorldResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/ping');

        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * @test
     */
     public function testUserRegistration()
     {
         $client = static::createClient();

         $userData = [
            "firstname" => "Pierre",
            "lastname" => "Dupont",
            "password" => "azerty",
            "username" => "toto",
            "city" => "Rouen",
            "zipcode" => "76000",
            "street_name" => "Allée Marceau",
            "street_number" => "12",
            "phone" => "07 83 89 02 76",
            "email" => "gregory@email.fr"
         ];

         $client->request(
             'POST',
             '/api/v1/register',
             [],
             [],
             ['CONTENT_TYPE' => 'application/json'],
             json_encode($userData)
         );

         echo $client->getResponse();

         $this->assertEquals(201, $client->getResponse()->getStatusCode());

     }
}
