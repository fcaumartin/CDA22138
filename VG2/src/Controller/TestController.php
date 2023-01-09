<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        

        return $this->render('test/index.html.twig', [
            
        ]);
    }

    #[Route('/test2/{id}', name: 'app_test2')]
    public function index2($id, ProduitRepository $repo): Response
    {
        $liste = $repo->findBy([
            "categorie" => $id
        ]);

        // dd($id);
        return $this->render('test/index2.html.twig', [
            'liste' => $liste,
        ]);
    }
}
