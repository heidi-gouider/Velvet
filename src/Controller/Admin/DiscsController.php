<?php

namespace App\Controller\Admin;

use App\Repository\DiscRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/admin/discs', name: 'admin_discs_')]
class DiscsController extends AbstractController
{
    private $discRepo;

    public function __construct(DiscRepository $discRepo)
    {
        $this->discRepo = $discRepo;

    }

    #[Route('/', name: 'index')]
        // Exemple d'annotation de sécurité
    // #[IsGranted('ROLE_ADMIN')] 
    public function index(): Response
    {
        $discs = $this->discRepo->findAll();

        return $this->render('admin/discs/index.html.twig', [
            'controller_name' => 'DiscsController',
            'discs' => $discs,

        ]);
    }
}
