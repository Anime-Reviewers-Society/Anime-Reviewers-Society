<?php

namespace App\Controller\Web;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserWebController extends AbstractController
{

    /**
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * * @Route("/admin/users", name="user.index")
     */
    public function userIndex(UserRepository $userRepository)
    {
        $user = $userRepository->findAll();
        return $this->render('admin/users/user.index.html.twig', [ 'user' => $user]);
    }
}