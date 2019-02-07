<?php

namespace App\Controller\Web\Admin;


use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminUserWebController extends AbstractController
{

    /**
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/admin/users", name="admin.user.index")
     */
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('admin/users/user.index.html.twig', ['user' => $user]);
    }

    /**
     * @param UserRepository $userRepository
     * @param int $id
     * @return Response
     *
     * @Route("/admin/user/{id}", name="admin.user.show")
     */
    public function show(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->find($id);
        return $this->render('admin/users/user.show.html.twig', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/new", name="admin.user.new")
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin.user.index');
        }

        return $this->render('admin/users/user.new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     *
     * @Route("/user/{id}/edit", name="admin.user.edit")
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin.user.index');
        }

        return $this->render('admin/users/user.edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);

    }


    /**
     * @param Request $request
     * @param User $user
     * @return Response
     *
     * @Route("/{id}", name="admin.user.delete")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin.user.index');
    }
}