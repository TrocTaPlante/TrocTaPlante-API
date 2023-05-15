<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ModeratorController extends AbstractController
{
    public static function register(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $user = new User();

            $user->setUsername($data["username"]);
            $user->setPassword($passwordHasher->hashPassword($user, $data["password"]));
            $user->setEmail($data["email"]);
            $user->setPassword($passwordHasher->hashPassword($user, $data["password"]));
            $user->setUsername($data["username"]);
            $user->setCity($data["city"]);
            $user->setZipcode($data["zipcode"]);
            $user->setLatitude($data["latitude"]);
            $user->setLongitude($data["longitude"]);
            $user->setStreetName($data["street_name"]);
            $user->setStreetNumber($data["street_number"]);
            $user->setPhone($data["phone"]);
            $user->setFirstname($data["firstname"]);
            $user->setLastname($data["lastname"]);
            $user->setRoles(["MODERATOR"]);

            $userRepository->save($user, true);

            return new JsonResponse('', 201, ["Content-Type" => "application/json"]);
        }catch (\Exception $exception){
            $errorMessage = $exception->getMessage();
            return new JsonResponse($errorMessage, 500, ["Content-Type" => "application/json"]);
        }

    }
}
