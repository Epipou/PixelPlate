<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController 
{
    #[Route('/', name: 'home')]
    public function index(): Response 
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig', [
            'contact_param' => 'Salut les amis!',
        ]);
    }   

    #[Route('/reservation', name: 'reservation')]
    public function reservation(): Response
    {
        return $this->render('main/reservation.html.twig');
    }

    #[Route('/infos', name: 'infos')]
    public function infos(): Response
    {
        return $this->render('main/infos.html.twig');
    }

    #[Route('/menu', name: 'menu')]
    public function menu(): Response
    {
        return $this->render('main/menu.html.twig');
    }

    #[Route('/carte', name: 'carte_vitrine')]
    public function carteVitrine(MenuRepository $menuRepository): Response
    {
        $menus = $menuRepository->findAll();

        return $this->render('main/carte.html.twig', [
            'menus' => $menus,
        ]);
    }
}
