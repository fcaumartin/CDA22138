<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $c1 = new Categorie();
        $c1->setName("Guitares");
        $manager->persist($c1);

        $c2 = new Categorie();
        $c2->setName("Percussions");
        $manager->persist($c2);

        $c3 = new Categorie();
        $c3->setName("Amplificateurs");
        $manager->persist($c3);

        $c4 = new Categorie();
        $c4->setName("Cuivres");
        $manager->persist($c4);

        $c5 = new Categorie();
        $c5->setName("Sonorisation");
        $manager->persist($c5);

        $c6 = new Categorie();
        $c6->setName("Accessoires");
        $manager->persist($c6);

        $p1 = new Produit();
        $p1->setLibelle("Guitare qui joue vite");
        $p1->setPrix(200);
        $p1->setCategorie($c1);
        $manager->persist($p1);

        $p2 = new Produit();
        $p2->setLibelle("Guitare qui joue encore plus vite");
        $p2->setPrix(3000);
        $p2->setCategorie($c1);
        $manager->persist($p2);



        $manager->flush();
    }
}
