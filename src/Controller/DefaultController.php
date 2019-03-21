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
        return $this->render('pages/faq.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/gcu", name="gcu")
     */
    public function GCU()
    {
        return $this->render('pages/gcu.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/legal-notice", name="legalNotice")
     */
    public function legalNotice()
    {
        return $this->render('pages/legalNotice.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
