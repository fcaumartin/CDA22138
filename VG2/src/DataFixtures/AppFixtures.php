<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\SeCompose;
use App\Entity\SousCategorie;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $h) {
        $this->hasher = $h;
    }

    public function load(ObjectManager $manager): void
    {
        $u1 = new User();
        $u1->setEmail("toto@gmail.com");
        $u1->setRoles(["ROLE_USER"]);
        $u1->setPassword($this->hasher->hashPassword($u1, "toto"));
        $manager->persist($u1);

        $u2 = new User();
        $u2->setEmail("admin@gmail.com");
        $u2->setRoles(["ROLE_ADMIN"]);
        $u2->setPassword($this->hasher->hashPassword($u2, "admin"));
        $manager->persist($u2);
        
        $c1 = new Categorie();
        $c1->setName("Guitares");
        $manager->persist($c1);

        $c2 = new Categorie();
        $c2->setName("Percussions");
        $manager->persist($c2);

        $c3 = new SousCategorie();
        $c3->setName("Guitares Electriques");
        $c3->setCategorie($c1);
        $manager->persist($c3);

        $c4 = new SousCategorie();
        $c4->setName("Guitares Accoustiques");
        $c4->setCategorie($c1);
        $manager->persist($c4);

        $p1 = new Produit();
        $p1->setLibelle("Guitare qui joue vite");
        $p1->setPrix(200);
        $p1->setSousCategorie($c3);
        $manager->persist($p1);

        $p2 = new Produit();
        $p2->setLibelle("Guitare qui joue encore plus vite");
        $p2->setPrix(3000);
        $p2->setSousCategorie($c4);
        $manager->persist($p2);

        $com1 = new Commande();
        $com1->setUser($u1);
        $com1->setDateCommande(new DateTime());
        $manager->persist($com1);

        $sc1 = new SeCompose();
        $sc1->setProduit($p1);
        $sc1->setCommande($com1);
        $sc1->setQuantite(5);
        $manager->persist($sc1);

        $sc2 = new SeCompose();
        $sc2->setProduit($p2);
        $sc2->setCommande($com1);
        $sc2->setQuantite(2);
        $manager->persist($sc2);

        $manager->flush();
    }
}
