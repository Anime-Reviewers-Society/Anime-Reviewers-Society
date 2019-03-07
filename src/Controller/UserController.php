<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
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
     * @Route("/profil", name="user.show")
     */
    public function profil(): Response
    {
        $user = $this->getUser();
        return $this->render('users/user.html.twig', [ 'user' => $user]);
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