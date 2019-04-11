<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/faq", name="faq")
     */
    public function index()
    {
        return $this->render('pages/pageFaq.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/gcu", name="gcu")
     */
    public function pageGCU()
    {
        return $this->render('pages/pageGcu.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/legal-notice", name="legalNotice")
     */
    public function pageLegalNotice()
    {
        return $this->render('pages/pageLegalNotice.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/ars", name="ars")
     */
    public function pageARS()
    {
        return $this->render('pages/pageArs.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        $form = $this->createForm(ContactType::class);

        return $this->render('pages/pageContact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}
