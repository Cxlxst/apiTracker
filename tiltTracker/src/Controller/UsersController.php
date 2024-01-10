<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
  
    #[Route('/users', name: 'app_users')]
    public function index(): Response
    {
        return $this->render('users/index.html.twig');
    }


    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('connexion/index.html.twig');
    }

    #[Route('/recherche', name: 'app_recherche')]
    public function rechercheUser(): Response
    {
        return $this->render('recherche/index.html.twig');
    }
}
