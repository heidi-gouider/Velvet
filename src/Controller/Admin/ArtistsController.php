<?php

namespace App\Controller\Admin;


use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/admin/artists', name: 'admin_artists_')]
class ArtistsController extends AbstractController
{
    private $artistRepo;

    public function __construct(ArtistRepository $artistRepo)
    {
        $this->artistRepo = $artistRepo;

    }
    #[Route('/', name: 'index')]
        // Exemple d'annotation de sécurité
    // #[IsGranted('ROLE_ADMIN')] 
    public function index(): Response
    {
        $artists = $this->artistRepo->findAll();

        return $this->render('admin/artists/index.html.twig', [
            'controller_name' => 'ArtistsController',
                         //on va envoyer à la vue notre variable qui stocke un tableau d'objets $artistes (c'est-à-dire tous les artistes trouvés dans la base de données)
                         'artists' => $artists,

        ]);
    }
}
