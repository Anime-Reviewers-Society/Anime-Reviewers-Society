<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\BadgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{
    /**
     * @return Response
     * @Route("/profil", name="user.profil")
     */
    public function profil(BadgeRepository $badgeRepository): Response
    {
        $user = $this->getUser();
        $badge = $badgeRepository->findAll();
        return $this->render('users/user.html.twig', [ 
            'user' => $user,
            'badge' => $badge
        ]);
    }

    /**
     * @param UserRepository $userRepository
     * @param int $id
     * @return Response
     *
     * @Route("/user/{id}", name="user.show")
     */
    public function publicProfil(BadgeRepository $badgeRepository, UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->find($id);
        $badge = $badgeRepository->findAll();
        return $this->render('users/user.profil.html.twig', [
            'user' => $user,
            'badge' => $badge
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     *
     * @Route("/profil/edit", name="profil.edit")
     */
    public function edit(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user.show');
        }

        return $this->render('users/user.edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}