<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PingController extends AbstractController
{
    #[Route('/ping', methods: 'GET')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'pong test soutenance',
        ]);
    }

}
