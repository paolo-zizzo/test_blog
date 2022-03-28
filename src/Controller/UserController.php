<?php

namespace App\Controller;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="user")
     */
    public function index(UserRepository $userRepository): Response
    {

        $users = $userRepository->findAll();
        
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users'=> $users,
        ]);
    }
}
