<?php

namespace App\Controller\Web\Admin;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTagWebController extends AbstractController
{
    /**
     * @param TagRepository $tagRepository
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/admin/tags", name="admin.tag.index", methods={"GET"})
     */
    public function index(TagRepository $tagRepository)
    {
        $tag = $tagRepository->findAll();

        return $this->render('admin/tag/tag.index.html.twig', ['tag' => $tag]);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("admin/tags/new", name="admin.tag.new")
     */
    public function new(Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tag);
                $entityManager->flush();
                return $this->redirectToRoute('admin.tag.index');
            } catch (Exception $exception) {
                return $this->redirectToRoute('admin.tag.new');
            }
        }

        return $this->render('admin/tag/tag.new.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return Response
     *
     * @Route("/admin/tag/{id}/edit", name="admin.tag.edit")
     */
    public function edit(Request $request, Tag $tag): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin.tag.index');
        }

        return $this->render('admin/tag/tag.edit.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return Response
     *
     * @Route("admin/tags/{id}", name="admin.tag.delete")
     */
    public function delete(Request $request, Tag $tag): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tag->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tag);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin.tag.index');
    }
}
