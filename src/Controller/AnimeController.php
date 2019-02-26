<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnimeRepository;

class AnimeController extends AbstractController
{
    /**
     * @param AnimeRepository $animeRepository
     * @return Response
     *
     * @Route("/", name="anime.index")
     */
    public function index(AnimeRepository $animeRepository): Response
    {
        $anime = $animeRepository->findAll();
        return $this->render('animes/anime.index.html.twig', ['anime' => $anime]);
    }

    /**
     * @param AnimeRepository $animeRepository
     * @param int $id
     * @return Response
     *
     * @Route("/anime/{id}", name="anime.show")
     */
    public function show(AnimeRepository $animeRepository, int $id): Response
    {
        $anime = $animeRepository->find($id);
        return $this->render('animes/anime.show.html.twig', ['anime' => $anime]);
    }
}
