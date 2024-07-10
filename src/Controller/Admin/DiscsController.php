<?php

namespace App\Controller\Admin;

use App\Repository\DiscRepository;
use App\Entity\Disc;
use App\Form\DiscsFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/admin/discs', name: 'admin_discs_')]
class DiscsController extends AbstractController
{
    private $discRepo;
    private $em;

    public function __construct(DiscRepository $discRepo)
    {
        $this->discRepo = $discRepo;
    }

    #[Route('/', name: 'index')]
    // Exemple d'annotation de sécurité
    // #[IsGranted('ROLE_ADMIN')] 
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $discs = $this->discRepo->findAll();

    // Utilisation de getQuantiteVendu pour obtenir la quantité vendue du disque
    // $quantiteVendu = $this->discRepo->getQuantiteVendu($discs);
     // Tableau pour stocker les quantités vendues de chaque disque
     $quantitieVendu = [];

     // Parcourir chaque disque pour obtenir la quantité vendue
    foreach ($discs as $disc) {
        $quantiteVendu[$disc->getId()] = $this->discRepo->getQuantiteVendu($disc);
        // $quantiteVendu = $this->discRepo->getQuantiteVendu($disc);
        // $quantitieVendu[$disc->getId()] = $quantiteVendu;
        // $quantitiesSold[$disc->getId()] = $quantiteVendu;

    }
        return $this->render('admin/discs/index.html.twig', [
            'controller_name' => 'DiscsController',
            'discs' => $discs,
            'quantiteVendu' => $quantiteVendu,

        ]);
    }
    // test de modif nombre de disques

    #[Route('/ajout', name: 'ajout')]
    // le EntityManagerInterface permet de faire le stockage en bdd
    public function ajout(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // je créé un nouveau disque
        $disc = new Disc();
        // $discs = $this->discRepo->findAll();

         // On crée le formulaire
         $discForm = $this->createForm(DiscsFormType::class, $disc);

         // On traite la requête du formulaire
         $discForm->handleRequest($request);
//  dd($discForm);
         //On vérifie si le formulaire est soumis ET valide
if($discForm->isSubmitted() && $discForm->isValid()){
    // je génère un slug 
    // pour mes prix qui seront en entier(je devrai les x100)
    // $prix = $disc->getPrix() *100;
    // $disc->setPrix($prix);
    // $disc->setVente($disc->getVente() + $someValue); 
    // On définit le dossier de destination
    $folder = 'discs';

 // On stocke
 $em->persist($disc);
 $em->flush();

//  ne pas oublier de créer une vue dans partials par exemple _flash.html.twig
// pour afficher le message
 $this->addFlash('success', 'Produit ajouté avec succès');
      // On redirige
      return $this->redirectToRoute('admin_discs_index');
}
return $this->render('admin/discs/ajout.html.twig',[
        'discForm' => $discForm->createView(),
        // return $this->render('admin/discs/index.html.twig', [
        //     'discs' => $disc,

        ]);

    }


    #[Route('/edition/{id}', name: 'edit')]
    // public function edit(Disc $disc, Request $request, EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService): Response
    public function edit(Disc $disc, Request $request, EntityManagerInterface $em): Response

    {
        // On vérifie si l'utilisateur peut éditer avec le Voter
        $this->denyAccessUnlessGranted('ROLE_ADMIN', $disc);

        // On divise le prix par 100
        // $prix = $disc->getPrix() / 100;
        // $disc->setPrix($prix);

        // On crée le formulaire
        $discForm = $this->createForm(DiscsFormType::class, $disc);

        // On traite la requête du formulaire
        $discForm->handleRequest($request);

        //On vérifie si le formulaire est soumis ET valide
        if($discForm->isSubmitted() && $discForm->isValid()){
            // On récupère les images
            // $images = $discForm->get('images')->getData();

            // foreach($images as $image){
                // On définit le dossier de destination
                $folder = 'products';

                // On appelle le service d'ajout
                // $fichier = $pictureService->add($image, $folder, 300, 300);

                // $img = new Images();
                // $img->setName($fichier);
                // $product->addImage($img);
            }
            
            
            // On génère le slug
            // $slug = $slugger->slug($disc->getTitle());
            // $disc->setSlug($slug);

            // On arrondit le prix 
            // $prix = $product->getPrice() * 100;
            // $product->setPrice($prix);

            // On stocke
            $em->persist($disc);
            $em->flush();

            $this->addFlash('success', 'Produit modifié avec succès');

            // On redirige
            // return $this->redirectToRoute('admin_discs_edit');

            
    
        return $this->render('admin/discs/edit.html.twig',[
            'discForm' => $discForm->createView(),
            // 'disc' => $disc,
        ]);
    }
    
    
    // return $this->redirectToRoute('admin_discs_index');




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