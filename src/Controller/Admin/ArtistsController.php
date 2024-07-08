<?php

namespace App\Controller\Admin;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use App\Form\ArtistsFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    // le EntityManagerInterface permettra de faire le stockage en bdd

    #[Route('/ajout', name: 'ajout')]
    public function ajout(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // je créé un nouvel artiste
        $artist = new Artist();
        // $artists = $this->discRepo->findAll();

         // On crée le formulaire
         $artistForm = $this->createForm(ArtistsFormType::class, $artist);

         // On traite la requête du formulaire
         $artistForm->handleRequest($request);
 
         //On vérifie si le formulaire est soumis ET valide
if($artistForm->isSubmitted() && $artistForm->isValid()){
    // On définit le dossier de destination
    $folder = 'artists';

 // On stocke
 $em->persist($artist);
 $em->flush();

 $this->addFlash('success', 'Artiste ajouté avec succès');
      // On redirige
      return $this->redirectToRoute('admin_artists_index');
}
return $this->render('admin/artists/ajout.html.twig',[
        'artistForm' => $artistForm->createView(),
        // return $this->render('admin/discs/index.html.twig', [
        //     'discs' => $disc,

        ]);

    }


}
