<?php


namespace App\Controller\Rest;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Repository\AnimeRepository;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class AnimeController extends AbstractFOSRestController {

    /**
     * @param AnimeRepository $animeRepository
     * @return View
     *
     * @Rest\Get("/animes")
     */
    public function getAnimes(AnimeRepository $animeRepository): View
    {
        $animes = $animeRepository->findAll();
        return new View($animes, Response::HTTP_OK);
    }

    /**
     * @param AnimeRepository $animeRepository
     * @return View
     *
     * @Rest\Get("/anime/{id}")
     */
    public function getAnime(AnimeRepository $animeRepository, int $id): View
    {
        $anime = $animeRepository->find($id);
        return new View($anime, Response::HTTP_OK);
    }
}