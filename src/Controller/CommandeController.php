<?php

namespace App\Controller;

use App\Entity\Commande; 
use App\Entity\Detail; 
use App\Entity\User;
use App\Repository\DiscRepository;
use App\Repository\DetailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/commande', name: 'app_commande_')]
class CommandeController extends AbstractController
{
    #[isGranted('ROLE_USER', message: "Vous devez avoir un compte pour accèder à cette page!")]

    #[Route('/ajout', name: 'ajout')]
    public function ajout(SessionInterface $session, DiscRepository $discRepo, EntityManagerInterface $em): Response
    {
        // je m'assure que l'utilisateur est connecté
        //on restrictionne l'accès ICI :
        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);


        if($panier === []){
            $this->addFlash('message', 'Votre panier est vide');
            return $this->redirectToRoute('app_accueil');
        }
  //Le panier n'est pas vide, on crée la commande
  $commande = new Commande();

  // On remplit la commande
  $commande->setUser($this->getUser());
 // Générer une référence unique entière
//  $reference = $this->generateUniqueReference();
//  $commande->setReference($reference);
// $dateCommande = $commande->getDateCommande();
//   $commande->setDateCommande(new \DateTime());
  $commande->setEtat(0); // Etat initial

  $total = 0;

  // On parcourt le panier pour créer les détails de commande
  foreach($panier as $item => $quantite){
      $detail = new Detail();

      // On va chercher le produit
      $disc = $discRepo->find($item);
      
      $prix = $disc->getPrix();

      // On crée le détail de commande
      $detail->setDisc($disc);
    //   $detail->setTotal($prix);
      $detail->setQuantity($quantite);
      $commande->addDetail($detail);

      $total += $prix * $quantite;

       // Persist chaque detail
       $em->persist($detail);
  }

  $commande->setTotal($total);

  // On persiste et on flush
  $em->persist($commande);
  $em->flush();

  $session->remove('panier');

  $this->addFlash('message', 'Commande créée avec succès');
  return $this->redirectToRoute('app_accueil');
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    
// je récupere l'historique de commande de l'utilisateur
// pour l'afficher via le lien dans la vue du panier
    /**
     * @Route("/panier/commandes", name="panier_commandes")
     */
    #[Route('/panier/commandes', name: 'panier_commandes')]

    public function index(UserInterface $user)
    {

    if (!$user instanceof User) {
        throw new \Exception('User must be an instance of App\Entity\User');
    }
        $commandes = $user->getCommandes();

 // Préparer les commandes avec leur libellé d'état
 $commandesWithEtatLibelle = [];
 foreach ($commandes as $commande) {
     $commandesWithEtatLibelle[] = [
         'commande' => $commande,
         'etat_libelle' => \App\Entity\Commande::getEtatLibelle($commande->getEtat()),
     ];

        return $this->render('panier/commandes.html.twig', [
            'commandes' => $commandes,
        ]);
    }
}
    // Définition de la méthode generateUniqueReference
    // private function generateUniqueReference(): int
    // {
        // Utilisez le timestamp actuel en secondes
        // $timestamp = time();
        // Ajouter une composante aléatoire pour garantir l'unicité
        // $randomComponent = random_int(1000, 9999);

        // Combinez les deux pour obtenir une référence unique
        // $reference = (int) ($timestamp . $randomComponent);

        // return $reference;
    // }

    //  #[Route("/commande/{id}", name : "commande_show")]
     
    //  public function show(Commande $commande): Response
    // {
    //     $etat = $commande->getEtat();
    //     $etatLibelle = Commande::getEtatLibelle($etat);

    //     return $this->render('commande/show.html.twig', [
    //         'commande' => $commande,
    //         'etat_libelle' => $etatLibelle,
    //     ]);
    // }
    // je recupère la méthode et le query builder du repo detail 
    // #[Route('/top_discs', name: 'top_discs')]
    #[Route('/', name: 'top_discs')]
private $detailRepo;
public function __construct(DetailRepository $detailRepo)
{
    $this->detailRepo = $detailRepo;
}
    public function topDiscs(): Response
    {
    
        // j'utilise la méthode créer dans le repo findByTopVente()
        $topDiscs = $this->detailRepo->findByTopVente();

        // je passe le résultat à ma vue
        return $this->render('accueil/index.html.twig', [
            'topDiscs' => $topDiscs,
        ]);
    }
}
