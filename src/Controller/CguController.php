<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CguController extends AbstractController
{
    // #[Route('/cgu', name: 'app_cgu')]
    // public function index(): Response
    #[Route('/politique', name: 'politique')]

    
/**
     * @Route("/politique", name="politique")
     */    public function politique(): Response
    {
        return $this->render('cgu/politique.html.twig');
    }

    #[Route('/cgu', name: 'conditions')]
    /**
     * @Route("/conditions", name="conditions")
     */
    public function conditions(): Response
    {
        return $this->render('cgu/conditions.html.twig');
    }

    #[Route('/cgu', name: 'accessibilite')]
    /**
     * @Route("/accessibilite", name="accessibilite")
     */
    public function accessibilite(): Response
    {
        return $this->render('cgu/index.html.twig', [
            'controller_name' => 'CguController',
        ]);
    }
}
