<?php

namespace App\Controller;

use App\Entity\Commande; 
use App\Entity\Detail; 
use App\Repository\DiscRepository;
use Doctrine\ORM\EntityManagerInterface;
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

  $commande->setDateCommande(new \DateTime());
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
      $detail->setQuantite($quantite);
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
}
