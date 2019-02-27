<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * * @Route("/user/{id}", name="user.show")
     */
    public function show(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->find($id);
        return $this->render('users/user.html.twig', [ 'user' => $user]);
    }
}