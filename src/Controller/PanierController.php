<?php

namespace App\Controller;

use App\Entity\Disc;
use App\Entity\Commande;
use App\Entity\Detail;
use App\Repository\DiscRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{
    // #[Route('/panier', name: 'app_panier')]
    #[Route('/', name: 'index')]
        public function index(SessionInterface $session, Request $request, DiscRepository $discRepo)
        {
            // j'initialise les variables
            $panier = $session->get('panier', []);
            // Pour permettre à l'utilisateur de revenir sur la dernière page visitée
            $referer = $request->headers->get('referer');
            $data = [];
            $total = 0;
    
            foreach ($panier as $id => $quantite) {
                $disc = $discRepo->find($id);
                $data[] = [
                    'disc' => $disc,
                    'quantite' => $quantite
                ];
                $total += $disc->getPrix() * $quantite;
            }
            return $this->render('panier/index.html.twig', compact('data', 'total'));
            // dd($data);
        }
    // ***Ajout au panier***
        #[Route('/ajout/{id}', name: 'ajout')]
        public function add(Disc $disc, SessionInterface $session, Request $request)
        {
    // dd($session);
            $quantite = $request->request->get('quantite');
            $action = $request->request->get('action');
    
            // Effectue la logique de gestion de quantité
            // if ($quantite < 1) {
            //     $quantite = 1;
            // }        
    
            if ($action === 'increment') {
                $quantite++;
            } elseif ($action === 'decrement' && $quantite > 1) {
                $quantite--;
            }
    
    
            $form = $this->createFormBuilder()
                ->add('quantite', IntegerType::class, [
                    'attr' => ['min' => 1, 'max' => 10],
                    // Définis les valeurs minimales et maximales
                ])
                ->getForm();
    
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $quantite = $form->get('quantite')->getData();
                // Traitement des données, y compris la quantité choisie
            }
            // récuperer l'id du disc
            $id = $disc->getId();

            // Obtenez le panier existant à partir de la session ou créez-en un nouveau.
            $panier = $session->get('panier', []);
    
            // Ajoutez ou mettez à jour la quantité du disc dans le panier.
            $panier[$disc->getId()] = $quantite;
    
            // Enregistrez le panier mis à jour dans la session.
            $session->set('panier', $panier);
    
    
             // Retournez une réponse, mais pas de redirection.
            //  return new Response('La quantité a été mise à jour dans le panier.');
            // dd($session);
    
            return $this->redirectToRoute('panier_index');
    
     // Récupérez l'URL de la page actuelle et stockez-la dans la session.
            $referer = $request->headers->get('referer');
            $session->set('referer_url', $referer);
    
            // Redirigez l'utilisateur vers la page précédente.
            // return $this->redirect($referer);        
            return $this->render('panier/index.html.twig', [
                'controller_name' => 'PanierController',
            ]);
        }
    
        #[Route('/ajout/{id}', name: 'ajout')]
        public function ajout(disc $disc, SessionInterface $session)
        {
            $id = $disc->getId();
            $panier = $session->get('panier', []);
    
            if (empty($panier[$id])) {
                $panier[$id] = 1;
            } else {
                $panier[$id]++;
            }
            
            $session->set('panier', $panier);
    
    
            return $this->redirectToRoute('panier_index');
        }
    
        #[Route('/retirer/{id}', name: 'retirer')]
        public function retirer(disc $disc, SessionInterface $session)
        {

            // récuperer l'id du disc
            $id = $disc->getId();
            // Obtenez le panier existant à partir de la session ou créez-en un nouveau.
            $panier = $session->get('panier', []);
            // app_commande_ajoutco
            //     unset($panier[$id]);
            if (!empty($panier[$id])) {
                if ($panier[$id] > 1)
                    $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
            
            // Enregistrez le panier mis à jour dans la session.
            $session->set('panier', $panier);
    
    
            return $this->redirectToRoute('panier_index');
        }
    
        #[Route('/supprimer/{id}', name: 'supprimer')]
        public function supprimer(Disc $disc, SessionInterface $session)
        {
            $id = $disc->getId();
            $panier = $session->get('panier', []);
    
            if (!empty($panier[$id])) {
                // si le panier est vide de défais la variable
                unset($panier[$id]);
            }
            $session->set('panier', $panier);
    
    
            return $this->redirectToRoute('panier_index');
        // return $this->render('panier/index.html.twig', [
        //     'controller_name' => 'PanierController',
        // ]);
    }

    #[Route('/valider', name: 'valider')]
    public function valider(SessionInterface $session, EntityManagerInterface $em)
    {
        $panier = $session->get('panier', []);
        if (empty($panier)) {
            return $this->redirectToRoute('panier_index');
        }

        $user = $this->getUser();

        $commande = new Commande();
        $commande->setUser($user);
        $commande->setDateCommande(new \DateTime());
        $commande->setEtat('1');

        $total = 0;
        foreach ($panier as $id => $quantite) {
            $disc = $em->getRepository(Disc::class)->find($id);
            $detail = new Detail();
            $detail->setCommande($commande);
            $detail->setDisc($disc);
            $detail->setQuantity($quantite);

            $em->persist($detail);

            $total += $disc->getPrix() * $quantite;
        }

        $commande->setTotal($total);

        $em->persist($commande);
        $em->flush();

        $session->remove('panier');

        $this->addFlash('success', 'Votre commande a bien été envoyée.');

        return $this->redirectToRoute('commande_detail', ['id' => $commande->getId()]);
    }

    #[Route('/commande/{id}', name: 'commande_detail')]
    public function commandeDetail(Commande $commande)
    {
        return $this->render('commande/index.html.twig', [
            'commande' => $commande,
        ]);
}
}