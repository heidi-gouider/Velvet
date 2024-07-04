<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/admin/users', name: 'admin_users_')]
class UsersController extends AbstractController
{
    private $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    #[Route('/', name: 'index')]
    // Exemple d'annotation de sécurité
    // #[IsGranted('ROLE_ADMIN')] 
    public function index(): Response
    {
        $users = $this->userRepo->findAll();
        // je debogue les données
        // dd($users);

        return $this->render('admin/users/index.html.twig', [
            'controller_name' => 'UsersController',
            'users' => $users,

        ]);
    }
}
