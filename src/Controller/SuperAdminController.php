<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SuperAdminController extends AbstractController
{
    #[Route('/api/v1/superadmin/createuser', methods: 'POST')]
    public function createUser(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($this->getUser()->getRoles()[0] !== "SUPERADMIN"){
            return new Response("Vous n'avez pas les droits pour accéder à cette ressource", 403);
        }
        return UserController::register($request,$userRepository,$passwordHasher);
    }
    #[Route('/api/v1/superadmin/createmoderator', methods: 'POST')]
    public function createModerator(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($this->getUser()->getRoles()[0] !== "SUPERADMIN"){
            return new Response("Vous n'avez pas les droits pour accéder à cette ressource", 403);
        }
        return ModeratorController::register($request,$userRepository,$passwordHasher);
    }
    #[Route('/api/v1/superadmin/createadmin', methods: 'POST')]
    public function createAdministrator(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($this->getUser()->getRoles()[0] !== "SUPERADMIN"){
            return new Response("Vous n'avez pas les droits pour accéder à cette ressource", 403);
        }
        return AdminController::register($request,$userRepository,$passwordHasher);
    }
}
