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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MembreController extends AbstractController
{

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

    /**
    * @Route("/membre/update/{id}", name="membre_update")
    */
    public function update(Membre $membre, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($membre);
            $manager->flush();

            $this->addFlash('success', "l'agence N" . $membre->getId() ."a bien été modifiée");

            return $this->redirectToRoute("membre_update'");
        }

        return $this->render("membre/membre_update.html.twig", [
            "formMembre" => $form->createView(),
            "membre" => $membre,
        ]);
    }

    /**
    * @Route("/membre/delete/{id}", name="membre_delete")
    */
    public function membre_delete(Membre $membre, EntityManagerInterface $manager){

        $manager->remove($membre);
        $manager->flush();

        $this->addFlash("Success", "Le membre N°". $membre->getId() . " a bien été supprimé");
        return $this->redirectToRoute('membre_afficher');

    }

     /**
    * @Route("/membre/details/{id}", name="membre_details")
    */
    public function membre_details(Membre $membre, EntityManagerInterface $manager, MembreRepository $repoMembre, $id){

        $membre = $repoMembre->find($id);

        return $this->render('membre/membre_details.html.twig', [
            'controller_name' => 'MembreController',
            "membre" => $membre,
        ]);
        return $this->redirectToRoute("membre_details");


    }







}
