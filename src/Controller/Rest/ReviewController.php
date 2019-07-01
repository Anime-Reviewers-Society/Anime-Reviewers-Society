<?php


namespace App\Controller\Rest;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class ReviewController extends AbstractFOSRestController {

    /**
     * @param ReviewRepository $reviewRepository
     * @param int $id
     * @return View
     *
     * @Rest\Get("/review/{id}")
     */
    public function getReviewAction(ReviewRepository $reviewRepository, int $id): View
    {
        $review = $reviewRepository->find($id);
        return new View($review, Response::HTTP_OK);
    }

    /**
     * @param ReviewRepository $reviewRepository
     * @param int $id
     * @param Request $request
     * @return View
     *
     * @Rest\Post("/review/{id}")
     */
    public function postReviewAction(ReviewRepository $reviewRepository, int $id, Request $request): View
    {
        $review = $reviewRepository->find($id);
        $review->setVote($request->get('vote'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($review);
        $entityManager->flush();
        return View::create($review, Response::HTTP_CREATED);
    }

}