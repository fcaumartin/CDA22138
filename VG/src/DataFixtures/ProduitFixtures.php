<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $produit = new Produit();
        $produit->setLibelle("Super produit");
        $produit->setPrix(2358.44);


        $manager->persist($produit);

        $manager->flush();
    }
}
