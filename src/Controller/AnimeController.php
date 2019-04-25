<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnimeRepository;
use Knp\Component\Pager\PaginatorInterface;

class AnimeController extends AbstractController
{
    /**
     * @param AnimeRepository $animeRepository
     * @return Response
     *
     * @Route("/", name="anime.index")
     */
    public function index(AnimeRepository $animeRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $anime = $paginator->paginate(
            $animeRepository->findAll(),
            $request->query->getInt('page', 1),
            20
        );
        return $this->render('animes/anime.index.html.twig', ['anime' => $anime]);
    }


    /**
     * @param AnimeRepository $animeRepository
     * @param string $title
     * @return Response
     *
     * @Route("/search", name="anime.search")
     */
    public function searchResult(AnimeRepository $animeRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $data = $request->query->get("search");
        $anime = $paginator->paginate(
            $animeRepository->findByStartingTitle($data['query']),
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('animes/anime.result.html.twig',  [
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
