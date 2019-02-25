<?php

namespace App\Controller\Admin;

use App\Entity\Anime;
use App\Form\AnimeType;
use App\Repository\AnimeRepository;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminAnimeWebController extends AbstractController
{
    /**
     * @param AnimeRepository $animeRepository
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/admin/animes", name="admin.anime.index")
     */
    public function index(AnimeRepository $animeRepository): Response
    {
        $anime = $animeRepository->findAll();
        return $this->render('admin/animes/anime.index.html.twig', ['anime' => $anime]);
    }

    /**
     * @param AnimeRepository $animeRepository
     * @param int $id
     * @return Response
     *
     * @Route("/admin/anime/{id}", name="admin.anime.show")
     */
    public function show(AnimeRepository $animeRepository, int $id): Response
    {
        $anime = $animeRepository->find($id);
        return $this->render('admin/animes/anime.show.html.twig', ['anime' => $anime]);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/admin/animes/new", name="admin.anime.new")
     */
    public function new(Request $request): Response
    {
        $anime = new Anime();
        $form = $this->createForm(AnimeType::class, $anime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('anime_image_directory'),
                    $fileName
                );
                $anime->setImage($fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($anime);
                $entityManager->flush();
                return $this->redirectToRoute('admin.anime.index');
            } catch (Exception $exception) {
                return $this->redirectToRoute('admin.anime.new');
            }
        }

        return $this->render('admin/animes/anime.new.html.twig', [
            'user' => $anime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Anime $anime
     * @return Response
     *
     * @Route("/admin/animes/{id}/edit", name="admin.anime.edit")
     */
    public function edit(Request $request, Anime $anime): Response
    {
        $form = $this->createForm(AnimeType::class, $anime);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin.anime.index');
        }

        return $this->render('admin/animes/anime.edit.html.twig', [
            'user' => $anime,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @param Anime $anime
     * @param Request $request
     * @return Response
     *
     * @Route("admin/anime/{id}", name="admin.anime.delete")
     */
    public function delete(Anime $anime, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anime->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($anime);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin.animes.index');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName(): string
    {
        return md5(uniqid());
    }
}
