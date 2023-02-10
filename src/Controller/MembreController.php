<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Repository\MembreRepository;
use App\Form\MembreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembreController extends AbstractController
{

    #[Route('/membre', name: 'membre')]
    public function afficher_ajouter_membre(MembreRepository $repoMembre, Request $request, EntityManagerInterface $manager): Response
    {
        $membres = $repoMembre->findAll();
        $objet_membre = new Membre;

        $form = $this->createForm(MembreType::class, $objet_membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($objet_membre);
            $manager->flush();

            $this->addFlash("Success", "Le membre N° " . $objet_membre->getId() . "a bien été ajouté");
        }

        return $this->render('membre/membre_afficher.html.twig', [
            'controller_name' => 'MembreController',
            "formMembre" => $form->createView(),
            "membre" => $membres,
        ]);
        return $this->redirectToRoute("membre_afficher");
    }
}
