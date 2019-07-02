<?php


namespace App\Controller\Rest;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class UserController extends AbstractFOSRestController {

    /**
     * @param UserRepository $userRepository
     * @return View
     *
     * @Rest\Get("/user/{id}")
     */
    public function getUserAction(UserRepository $userRepository, int $id): View
    {
        $user = $userRepository->find($id);
        return new View($user, Response::HTTP_OK);
    }

}