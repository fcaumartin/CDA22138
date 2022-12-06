<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use App\Repository\SousCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(CategorieRepository $repo): Response
    {
        

        return $this->render('accueil/index.html.twig', [
            'liste_des_categories' => $repo->findAll(),
        ]);
    }

    #[Route('/souscategories/{categorie}', name: 'app_souscategories')]
    public function souscategories(CategorieRepository $repo1, SousCategorieRepository $repo2,  $categorie): Response
    {
        // $cat = $repo1->find($categorie);
        // $scat = $cat->getSousCategories();

        // ou 
        
        $scat = $repo2->findBy([
            "categorie" => $categorie
        ]);

        return $this->render('accueil/souscategories.html.twig', [
            'liste_des_souscategories' => $scat
        ]);
    }

    #[Route('/produits/{souscategorie}', name: 'app_produits')]
    public function produits(ProduitRepository $repo,  $souscategorie): Response
    {

        $produits = $repo->findBy([
            "sousCategorie" => $souscategorie
        ]);

        return $this->render('accueil/produits.html.twig', [
            'liste_des_produits' => $produits
        ]);
    }
}
