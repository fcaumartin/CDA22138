<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $produit1 = new Produit();
        $produit1->setLibelle("Guitare");
        $produit1->setPrix(111.11);
        $manager->persist($produit1);

        $produit2 = new Produit();
        $produit2->setLibelle("Piano");
        $produit2->setPrix(222.22);
        $manager->persist($produit2);

        $produit3 = new Produit();
        $produit3->setLibelle("Batterie");
        $produit3->setPrix(333.33);
        $manager->persist($produit3);

        $manager->flush();
    }
}
