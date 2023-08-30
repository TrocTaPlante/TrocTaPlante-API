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
     public function testUserRegistration()
     {
         $client = static::createClient();

         $userData = [
            "firstname" => "Pierre",
            "lastname" => "Dupont",
            "password" => "azerty",
            "username" => "JeanPierre",
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

         $this->assertEquals(201, $client->getResponse()->getStatusCode());

     }

    /**
    * @test
    */
    public function testUserLogin()
    {
        $client = static::createClient();

        $userData = [
            "username" => "JeanPierre",
            "password" => "azerty"
        ];

        $client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($userData)
        );

        echo $client->getResponse();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function testGetUserInfoWithoutLogin(){
        $client = static::createClient();

        $client->request(
            'GET',
            '/api/v1/getuserinfo?username=toto',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

}
