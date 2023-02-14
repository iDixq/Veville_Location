<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            "formAccueil" => $form->creatview(),
            "dataAccueil" => $dataAccueil

        ]);
    }

    #[Route('/membre', name: 'membre_afficher')]
    public function afficher_ajouter_membre(MembreRepository $repoMembre, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $objet_membre = new Membre;
        $membres = $repoMembre->findAll();
        

        $form = $this->createForm(MembreType::class, $objet_membre);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            // $hashedPassword = $passwordHasher->hashPassword(
            //     $objet_membre,
            //     $request->get("membre")["mdp"]
            // );
        
            // $objet_membre->setPassword($hashedPassword);
            // $repoMembre->save($objet_membre, true);
            $objet_membre->setDateEnregistrement(new \DateTime());
            $manager->persist($objet_membre);
            $manager->flush();

            $this->addFlash("Success", "Le membre N° " . $objet_membre->getId() . "a bien été ajouté");
        }

        return $this->render('membre/membre_afficher.html.twig', [
            'controller_name' => 'MembreController',
            "formMembre" => $form->createView(),
            "membres" => $membres,
        ]);
        return $this->redirectToRoute("membre_afficher");

    }

   

}


