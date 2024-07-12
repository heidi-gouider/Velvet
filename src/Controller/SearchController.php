<?php

namespace App\Controller;

use App\Entity\Disc;
use App\Entity\Artist;
use App\Form\SearchType;
use App\Repository\ArtistRepository;
use App\Repository\DiscRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    private $artistRepo;
    private $discRepo;

    public function __construct(ArtistRepository $artistRepo, DiscRepository $discRepo)
    {
        $this->artistRepo = $artistRepo;
        $this->discRepo = $discRepo;

    }


      #[Route("/recherche", name : "search_results")]
      #[Route("/", name : "app_accueil")]

    public function search(Request $request): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        // $artists = $this->artistRepo->findAll();
        // $discs = $this->discRepo->findAll();

        $artistQuery = $form->get('artistQuery')->getData();
        $discQuery = $form->get('discQuery')->getData();

        $query = null;
        $discs = [];
        $artists = [];

       if ($artistQuery) {
            $artists = $this->artistRepo->createQueryBuilder('a')
                ->where('a.name LIKE :query')
                ->setParameter('query', '%' . $artistQuery . '%')
                ->getQuery()
                ->getResult();
        } else {
            $artists = $this->artistRepo->findAll();
        }

        if ($discQuery) {
            $discs = $this->discRepo->createQueryBuilder('d')
                ->where('d.title LIKE :query')
                ->setParameter('query', '%' . $discQuery . '%')
                ->getQuery()
                ->getResult();
        } else {
            $discs = $this->discRepo->findAll();
        }
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $query = $form->get('query')->getData();
            

            // Recherche des disques
            // $discs = $this->discRepo()
            //     ->getRepository(Disc::class)
            //     ->createQueryBuilder('d')
            //     ->where('d.title LIKE :query')
            //     ->setParameter('query', '%' . $query . '%')
            //     ->getQuery()
            //     ->getResult();

            // Recherche des artistes
            // $artists = $this->getDoctrine()
            //     ->getRepository(Artist::class)
            //     ->createQueryBuilder('a')
            //     ->where('a.name LIKE :query')
            //     ->setParameter('query', '%' . $query . '%')
            //     ->getQuery()
            //     ->getResult();
        
        
        return $this->render('search/results.html.twig', [
            'form' => $form->createView(),
            'query' => $query,
            'discs' => $discs,
            'artists' => $artists,
        ]);
    }
}
