<?php

namespace App\Controller;

use App\Helpers\Serialize;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SearchController extends AbstractController
{
    #[Route('/api/v1/search', methods: ['GET'])]
    public function index(Request $request, UserRepository $userRepository, ProductRepository $productRepository, SerializerInterface $serializer): JsonResponse
    {
        $searchQuery = $request->query->get("query");

        $users = $userRepository->findBySearchQuery($searchQuery);
        $products = $productRepository->findBySearchQuery($searchQuery);

        $data = [
            "users" => Serialize::serializeUser($serializer,$users),
            "products" => Serialize::serializeProduct($serializer,$products)
        ];

        return new JsonResponse($data, 200, ["Content-Type" => "application/json"]);
    }
}
