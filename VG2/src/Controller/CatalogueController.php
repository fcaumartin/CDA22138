<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogueController extends AbstractController
{
    #[Route('/', name: 'app_catalogue')]
    public function index(CategorieRepository $repo): Response
    {

        $categories = $repo->findAll();

        return $this->render('catalogue/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/categorie/{categorie}', name: 'app_categorie')]
    public function categorie(Categorie $categorie): Response
    {

        // dd($categorie);
        return $this->render('catalogue/categorie.html.twig', [
            'categorie' => $categorie
        ]);
    }
}
