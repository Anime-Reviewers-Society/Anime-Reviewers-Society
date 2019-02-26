<?php

namespace App\Controller\Admin;

use App\Entity\Target;
use App\Form\TargetType;
use App\Repository\TargetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TargetController extends AbstractController
{
    /**
     * @param TargetRepository $targetRepository
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/admin/targets", name="admin.target.index", methods={"GET"})
     */
    public function index(TargetRepository $targetRepository): Response
    {
        $target = $targetRepository->findAll();
        return $this->render('admin/targets/target.index.html.twig', ['target' => $target]);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("admin/targets/new", name="admin.target.new")
     */
    public function new(Request $request): Response
    {
        $target = new Target();
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($target);
                $entityManager->flush();
                return $this->redirectToRoute('admin.target.index');
            } catch (Exception $exception) {
                return $this->redirectToRoute('admin.target.new');
            }
        }

        return $this->render('admin/targets/target.new.html.twig', [
            'target' => $target,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Target $target
     * @return Response
     *
     * @Route("/admin/target/{id}/edit", name="admin.target.edit")
     */
    public function edit(Request $request, Target $target): Response
    {
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin.target.index');
        }

        return $this->render('admin/targets/target.edit.html.twig', [
            'target' => $target,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Target $target
     * @return Response
     *
     * @Route("admin/targets/{id}", name="admin.target.delete")
     */
    public function delete(Request $request, Target $target): Response
    {
        if ($this->isCsrfTokenValid('delete'.$target->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($target);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin.target.index');
    }
}
