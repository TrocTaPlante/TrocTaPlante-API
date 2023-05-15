<?php

namespace App\Controller;

use App\Entity\User;
use App\Helpers\Location;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/v1/ping', methods: "GET")]
    public function ping (): JsonResponse
    {
        return new JsonResponse('pong', 200, ["Content-Type" => "application/json"]);
    }
    #[Route('/api/v1/register', methods: "POST")]
    public static function register(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $address = $data["street_number"] . " " . $data["street_name"] . ", " . $data["zipcode"] . " " . $data["city"];
            $coordinates = Location::getGPSCoordinatesFromPostalAddress($address);

            $user = new User();

            $user->setUsername($data["username"]);
            $user->setPassword($passwordHasher->hashPassword($user, $data["password"]));
            $user->setEmail($data["email"]);
            $user->setPassword($passwordHasher->hashPassword($user, $data["password"]));
            $user->setUsername($data["username"]);
            $user->setCity($data["city"]);
            $user->setZipcode($data["zipcode"]);
            $user->setLatitude($coordinates["latitude"]);
            $user->setLongitude($coordinates["longitude"]);
            $user->setStreetName($data["street_name"]);
            $user->setStreetNumber($data["street_number"]);
            $user->setPhone($data["phone"]);
            $user->setFirstname($data["firstname"]);
            $user->setLastname($data["lastname"]);
            $user->setRoles(["USER"]);
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdatedAt(new \DateTimeImmutable());

            $userRepository->save($user, true);

            return new JsonResponse('', 201, ["Content-Type" => "application/json"]);
        }catch (\Exception $exception){
            $errorMessage = $exception->getMessage();
            return new JsonResponse($errorMessage, 500, ["Content-Type" => "application/json"]);
        }

    }

}
