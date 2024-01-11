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

    #[Route('/visibilite', name: 'app_visibilite')]
    public function visibiliteuser(): Response
    {
        return $this->render('visibilite/index.html.twig');
    }

    #[Route('/infos', name: 'app_infos')]
    public function infosuser(): Response
    {
        return $this->render('informations/index.html.twig');
    }

    #[Route('/newuser', name: 'newuser')]
    public function newuser(): Response
    {
        return $this->render('newuser/index.html.twig');
    }

    #[Route('/profil', name: 'app_profil')]
    public function profilUser(): Response
    {
        return $this->render('profil/index.html.twig');
    }
}
