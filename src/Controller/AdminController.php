<?php

namespace App\Controller;

use App\Entity\User;
use App\Helpers\Serialize;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AdminController extends AbstractController
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
            $user->setRoles(["ADMIN"]);

            $userRepository->save($user, true);

            return new JsonResponse('', 201, ["Content-Type" => "application/json"]);
        }catch (\Exception $exception){
            $errorMessage = $exception->getMessage();
            return new JsonResponse($errorMessage, 500, ["Content-Type" => "application/json"]);
        }

    }

    #[Route('/api/v1/admin/getallusers', methods: ['GET'])]
    public function getUsers(UserRepository $userRepository, SerializerInterface $serializer){
        try {
            if ($this->getUser()->getRoles() !== ["ADMIN"] && $this->getUser()->getRoles() !== ["SUPERADMIN"]){
                return new JsonResponse("Vous n'êtes autorisé à utiliser cette route", 403, ["Content-Type" => "application/json"]);
            }

            $users = $userRepository->findByRole("USER");
            $userList = Serialize::serializeUser($serializer,$users);

            return new JsonResponse($userList, 200, ["Content-Type" => "application/json"]);
        }catch (\Exception $exception){
            $errorMessage = $exception->getMessage();
            return new JsonResponse($errorMessage, 500, ["Content-Type" => "application/json"]);
        }
    }

    #[Route('/api/v1/admin/disableuser/{id}', methods: ['PUT'])]
    public function disableUser(UserRepository $userRepository, User $user){
        try {
            if ($this->getUser()->getRoles() !== ["ADMIN"] && $this->getUser()->getRoles() !== ["SUPERADMIN"]){
                return new JsonResponse("Vous n'êtes autorisé à utiliser cette route", 403, ["Content-Type" => "application/json"]);
            }
            if ($user === null){
                return new JsonResponse("L'utilisateur n'existe pas", 404, ["Content-Type" => "application/json"]);
            }

            $user->setIsBloqued(true);
            $userRepository->save($user, true);

            $message = "Le compte de l'utilisateur " . $user->getUsername() . " a été bloqué";
            return new JsonResponse($message, 200, ["Content-Type" => "application/json"]);

        }catch (\Exception $exception){
            $errorMessage = $exception->getMessage();
            return new JsonResponse($errorMessage, 500, ["Content-Type" => "application/json"]);
        }
    }

    #[Route('/api/v1/admin/enableuser/{id}', methods: ['PUT'])]
    public function enablerUser(UserRepository $userRepository, User $user){
        try {
            if ($this->getUser()->getRoles() !== ["ADMIN"] && $this->getUser()->getRoles() !== ["SUPERADMIN"]){
                return new JsonResponse("Vous n'êtes autorisé à utiliser cette route", 403, ["Content-Type" => "application/json"]);
            }
            if ($user === null){
                return new JsonResponse("L'utilisateur n'existe pas", 404, ["Content-Type" => "application/json"]);
            }

            $user->setIsBloqued(false);
            $userRepository->save($user, true);

            $message = "Le compte de l'utilisateur " . $user->getUsername() . " a été débloqué";
            return new JsonResponse($message, 200, ["Content-Type" => "application/json"]);

        }catch (\Exception $exception){
            $errorMessage = $exception->getMessage();
            return new JsonResponse($errorMessage, 500, ["Content-Type" => "application/json"]);
        }
    }

    #[Route('/api/v1/admin/statistics', methods: ['GET'])]
    public function statistics(Request $request,UserRepository $userRepository, ProductRepository $productRepository){
        $usersCount = count($userRepository->findAll());
        $productsCount = count($productRepository->findAll());
        $filter = $request->query->get("filter");

        switch ($filter){
            case "users":
                $statistics = [
                    "users" => $usersCount
                ];
            break;
            case "products":
                $statistics = [
                    "products" => $productsCount
                ];
            break;
            default:
                $statistics = [
                    "users" => $usersCount,
                    "products" => $productsCount
                ];
            break;
        }

        return new JsonResponse($statistics, 200, ["Content-Type" => "application/json"]);
    }

    #[Route('/api/v1/admin/statistics/export', methods: ['GET'])]
    public function export($request,UserRepository $userRepository, ProductRepository $productRepository){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="export.csv"');

        $usersCount = count($userRepository->findAll());
        $productsCount = count($productRepository->findAll());
        $filter = $request->query->get("filter");

        switch ($filter){
            case "users":
                $statistics = [
                    "users" => $usersCount
                ];
                break;
            case "products":
                $statistics = [
                    "products" => $productsCount
                ];
                break;
            default:
                $statistics = [
                    "users" => $usersCount,
                    "products" => $productsCount
                ];
                break;
        }

        $data = $statistics;

        $fp = fopen('php://output', 'wb');
        foreach ( $data as $line ) {
            $val = explode(",", $line);
            fputcsv($fp, $val);
        }
        fclose($fp);
    }
}
