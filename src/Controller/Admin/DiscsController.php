<?php

namespace App\Controller\Admin;

use App\Repository\DiscRepository;
use App\Entity\Disc;
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
    // test de modif nombre de disques

    #[Route('/ajout', name: 'ajout')]
    public function ajout(): Response
    {
        $discs = $this->discRepo->findAll();

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/discs/index.html.twig', [
            'discs' => $discs,

        ]);

    }


    // #[Route('/retirer/{id}', name: 'retirer')]
    // public function retirer(disc $discs)
    // {

    //     $id = $discs->getId();


    //     return $this->redirectToRoute('discs_index');
    // }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function supprimer(disc $disc)
    {
                // récuperer l'id du disc
        $id = $disc->getId();

        return $this->redirectToRoute('discs_index');
        // return $this->render('panier/index.html.twig', [
        //     'controller_name' => 'PanierController',
        // ]);
    }

    #[Route('/valider', name: 'valider')]
    public function valider()
    {
        return $this->redirectToRoute('panier_index');
    }
}
