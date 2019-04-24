<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param string $title
     * @return Response
     *
     * @Route("/test/{title}", name="test.result")
     */
    public function searchResult(AnimeRepository $animeRepository, string $title): Response
    {
        print_r($title);
        $anime = $animeRepository->findByStartingTitle($title);

        return $this->render('animes/test.result.html.twig',  [
            'anime' => $anime
        ]);
    }

    /**
     * @param AnimeRepository $animeRepository
     * @param int $id
     * @return Response
     *
     * @Route("/anime/{id}", name="anime.show")
     */
    public function show(AnimeRepository $animeRepository, int $id, Request $request): Response
    {
        $anime = $animeRepository->find($id);
        $reviews = $anime->getReview();
        $review = new Review();
        $form = $this->createForm(ReviewType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            //fill values in the form
            $review->setAuthor($this->getUser());
            $review->setDate(new \DateTimeImmutable("now"));
            $review->setComment($form->get("comment")->getData());
            $review->setNote($form->get("note")->getData());
            $review->setAnime($anime);

            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('anime.show', ['id' => $id]);
        }

        return $this->render('animes/anime.show.html.twig', [
                'anime' => $anime,
                'form' => $form->createView(),
                'reviews' => $reviews
            ]
        );
    }
}
