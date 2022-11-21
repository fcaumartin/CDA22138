<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function accueil(): Response
    {
        return $this->render('catalogue/accueil.html.twig', [
        ]);
    }

    #[Route('/apropos', name: 'apropos')]
    public function apropos(): Response
    {
        return $this->render('catalogue/apropos.html.twig', [
        ]);
    }

    #[Route('/categories', name: 'categories')]
    public function categories(): Response
    {
        return $this->render('catalogue/categories.html.twig', [
        ]);
    }

    #[Route('/produits', name: 'produits')]
    public function produits(ProduitRepository $repo): Response
    {
        $liste_des_produits = $repo->findAll();

        // dd($liste_des_produits);

        return $this->render('catalogue/produits.html.twig', [
            "produits" => $liste_des_produits
        ]);
    }
}
