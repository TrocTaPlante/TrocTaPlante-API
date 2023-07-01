<?php

namespace App\Tests\Controllers;

use ApiTestCase\JsonApiTestCase;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserControllerTest extends JsonApiTestCase
{
    // public function __construct(UserPasswordHasherInterface $passwordHasher)
    // {
    //     $this->passwordHasher = $passwordHasher;
    // }

    public function testGetHelloWorldResponse()
    {
        $this->client->request('GET', '/ping');

        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * @test
     */
    // public function testCreateUser() 
    // {

    //     $user = new User();
    //     $user->setUsername("test");
    //     $user->setPassword("test");
    //     $user->setEmail("test@test.fr");
    //     $user->setPassword($passwordHasher->hashPassword($user, "test"));
    //     $user->setUsername("test");
    //     $user->setCity("test");
    //     $user->setZipcode("test");
    //     $user->setLatitude(0);
    //     $user->setLongitude(0);
    //     $user->setStreetName("test");
    //     $user->setStreetNumber("test");
    //     $user->setPhone("test");
    //     $user->setFirstname("test");
    //     $user->setLastname("test");
    //     $user->setRoles(["USER"]);
    //     $user->setCreatedAt(new \DateTimeImmutable());
    //     $user->setUpdatedAt(new \DateTimeImmutable());

    //     $this->client->request('POST', '/api/v1/register', [
    //         'headers' => ['Content-Type' => 'application/json'],
    //         'json' => [
    //             'username' => $user->getUsername(),
    //             'password' => $user->getPassword(),
    //             'email' => $user->getEmail(),
    //             'city' => $user->getCity(),
    //             'zipcode' => $user->getZipcode(),
    //             'latitude' => $user->getLatitude(),
    //             'longitude' => $user->getLongitude(),
    //             'street_name' => $user->getStreetName(),
    //             'street_number' => $user->getStreetNumber(),
    //             'phone' => $user->getPhone(),
    //             'firstname' => $user->getFirstname(),
    //             'lastname' => $user->getLastname(),
    //             'roles' => $user->getRoles(),
    //             'created_at' => $user->getCreatedAt(),
    //             'updated_at' => $user->getUpdatedAt(),
    //         ],
    //     ]);

    //     $this->assertResponseStatusCodeSame(201);
    // }
}
