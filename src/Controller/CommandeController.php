<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commande;


class CommandeController extends AbstractController
{
    #[Route('/admin/commande', name: 'app_commande')]
    public function index(): Response
    {
        $commande = new Commande;



        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
}
