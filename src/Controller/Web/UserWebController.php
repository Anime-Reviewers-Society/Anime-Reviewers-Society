<?php
/**
 * Created by PhpStorm.
 * User: 33623
 * Date: 04/02/2019
 * Time: 21:50
 */

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
     * * @Route("/users", name="user.index")
     */
    public function userIndex(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        return $this->render('user.index.html.twig', [ 'user' => $users]);
    }
}