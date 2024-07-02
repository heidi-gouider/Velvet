<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/admin/users', name: 'admin_users_')]
class UsersController extends AbstractController
{
    #[Route('/', name: 'index')]
        // Exemple d'annotation de sécurité
    // #[IsGranted('ROLE_ADMIN')] 
    public function index(): Response
    {
        return $this->render('admin/users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }
}