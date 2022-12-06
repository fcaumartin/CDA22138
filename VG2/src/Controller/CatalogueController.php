<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use App\Repository\SousCategorieRepository;
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

    #[Route('/categorie/{id}', name: 'app_categorie')]
    public function categorie(SousCategorieRepository $repo, $id): Response
    {
        $liste = $repo->findBy([ "categorie" => $id]);

        // dd($categorie);
        return $this->render('catalogue/categorie.html.twig', [
            'liste' => $liste
        ]);
    }

    #[Route('/produits/{id}', name: 'app_produits')]
    public function produits(ProduitRepository $repo, $id): Response
    {
        $liste = $repo->findBy([ "sousCategorie" => $id]);

        // dd($categorie);
        return $this->render('catalogue/produits.html.twig', [
            'liste' => $liste
        ]);
    }


}
