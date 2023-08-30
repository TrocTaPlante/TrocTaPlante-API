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
            'message' => 'pong et si tu lis ceci c\'est que tu as réussi à faire fonctionner le pipelines de déploiement continue et Docker',
        ]);
    }

}
