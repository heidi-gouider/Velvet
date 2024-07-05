<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\DiscRepository;
use App\Repository\DetailRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class AccueilController extends AbstractController
{
    //On va avoir souvent besoin d'injecter les respositories de nos entités dans les contrôleurs et les services
    //Pour ne pas les injecter dans chaque fonction, on va les instancier UNE SEULE fois dans le constructeur de notre contrôleur:
    //N'oubliez pas d'importer vos respositories (les lignes "use..." en haut de la page)
    private $artistRepo;
    private $discRepo;
    // private $em;

    public function __construct(ArtistRepository $artistRepo, DiscRepository $discRepo)
    {
        $this->artistRepo = $artistRepo;
        $this->discRepo = $discRepo;
        // $this->em = $em;

    }


    // #[Route('/accueil', name: 'app_accueil')]
    #[Route('/', name: 'app_accueil')]

    public function index(): Response
    {
        //on appelle le repository pour accéder à la fonction
        // $artists = $this->artistRepo->getSomeArtists("Neil");
        $disc = $this->discRepo->findAll();
        // $disc = $this->discRepo->find($discId);;
        // $sales = $this->discRepo->findBySales(2);
        //on teste le contenu de la variable $artistes : dd() veut dire Dump and Die
            // dd($artistes); 
         //on appelle la fonction `findAll()` du repository de la classe `Artist` afin de récupérer tous les artists de la base de données;
         $artists = $this->artistRepo->findAll();
        // dump($artists);

        // $topDiscsVendu = $this->discRepo->findByTopDiscsVendu(2);
        // $topDiscsVendu = $this->discRepo->findBySales(); 

        // $user = $this->security->getUser();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'discs' => $disc,
             //on va envoyer à la vue notre variable qui stocke un tableau d'objets $artistes (c'est-à-dire tous les artistes trouvés dans la base de données)
             'artists' => $artists,
            //  'topDiscsVendu' => $topDiscsVendu,
            //  'sales' => $sales
        ]);
    }

    // function index (Request $request, EntityManagerInterface $em,UserPasswordHasherInterface $hasher, Security $security): 
    // Response {
    //     dd($security->getUser());


    #[Route('/discs', name: 'app_discs')]
    public function discs(): Response
    {
        //on appelle la fonction `findAll()` du repository de la classe `Disc` afin de récupérer tous les discs de la base de données;
        $discs = $this->discRepo->findAll();
        dump($discs);

        return $this->render('accueil/discs.html.twig', [
            'controller_name' => 'AccueilController',

            'discs' => $discs
        ]);
    }

    #[Route('/artists', name: 'app_artists')]
    public function artists(): Response
    {
        $artists = $this->artistRepo->findAll();
        dump($artists);
        return $this->render('accueil/artists.html.twig', [
            'controller_name' => 'AccueilController',
            'artists' => $artists
        ]);
    }

    #[Route('/discs/{artist_id}', name: 'app_discs_artist')]
    public function discsArtist(int $artist_id, ArtistRepository $artistRepo): Response
    {
        // je récupère la categorie correspondant à l'id
        $artist = $this->artistRepo->find($artist_id);
        dump($artist);

        $discs = $artist->getDiscs();
        return $this->render('accueil/discsArtist.html.twig', [
            // 'controller_name' => 'CatalogueController',
            'artists' => $artist,
            'discs' => $discs,
        ]);
    }

        // je recupère la méthode et le query builder du repo detail 
        #[Route('/top_discs', name: 'top_discs')]
        public function topDiscs(DetailRepository $detailRepo): Response
        {
            // j'utilise la méthode créer dans le repo findByTopVente()
            $topDiscs = $detailRepo->findByTopVente();
    
            // je passe le résultat à ma vue
            return $this->render('accueil/index.html.twig', [
                'topDiscs' => $topDiscs,
            ]);
        }
    

}
