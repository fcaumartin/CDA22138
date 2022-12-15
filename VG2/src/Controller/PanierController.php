<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Produit;
use App\Entity\SeCompose;
use App\Repository\ProduitRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/add/{id}', name: 'app_add')]
    public function add(SessionInterface $session,  Produit $id): Response
    {
        $panier = $session->get("panier", []);

        $panier[] = $id;

        $session->set("panier", $panier);


        return $this->redirect("/panier");
    }

    #[Route('/panier', name: 'app_panier')]
    public function index(SessionInterface $session): Response
    {
        $panier = $session->get("panier", []);

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    #[Route('/clear', name: 'app_clear')]
    public function clear(SessionInterface $session): Response
    {
        $panier = $session->set("panier", []);

        return $this->redirect("/panier");
    }

    #[IsGranted("ROLE_USER")]
    #[Route('/valid', name: 'app_valid')]
    public function valid(ProduitRepository $repo, SessionInterface $session, EntityManagerInterface $manager): Response
    {
        $panier = $session->get("panier", []);

        $com = new Commande();
        $com->setUser($this->getUser());
        $com->setDateCommande(new DateTime());
        $manager->persist($com);

        foreach ($panier as $produit) {
            $p = $repo->find($produit->getId());

            $sc = new SeCompose();
            $sc->setCommande($com);
            $sc->setProduit($p);
            $sc->setQuantite(3);
            $manager->persist($sc);
            $manager->flush();
        }


        $session->set("panier", []);

        return $this->redirect("/profile");
    }
}
