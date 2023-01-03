<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    #[Route('/client/add', name: 'app_client')]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $client = new Client();
        
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($client);
            $manager->flush();
            
            return $this->redirect("/");
        }

        return $this->render('client/index.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }
}
