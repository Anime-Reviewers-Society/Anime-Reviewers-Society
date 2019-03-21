<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/faq", name="faq")
     */
    public function index()
    {
        return $this->render('faq/faq.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
