<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commande;
use App\Form\AccueilType;
use App\Repository\AgenceRepository;
use App\Repository\CommandeRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function accueilAfficher(VehiculeRepository $repoVehicule, AgenceRepository $repoAgence, Request $request, EntityManagerInterface $manager): Response
    {

        $v = $repoVehicule->getAllVehicule();
        $agence = $repoAgence->findAll();

        if ($request->isMethod('post')) {
            // dd($request);
            $agences = $repoAgence->findAll();

            $idAgence = $request->request->get('ag');
            //    dd($agence);

            $v = $repoVehicule->getIdAgence($idAgence);

            $start = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('timeDebut'));
            $end = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('timeFin'));

            $intervalle = $start->diff($end);

            // $start = $commande->gej();
            // $end =  $commande->getEnd();
            // $diff = $start->diff($end);
            // $commande->setTotal( ($diff));

            // dd($intervalle);
            return $this->render(
                'accueil/index.html.twig',

                [
                    'filterVehicule' => true,
                    'controller_name' => 'AccueilController',
                    "v" => $v,
                    "agences" => $agences,
                    'day' => $intervalle->days,
                    'start' => $start->format('y-m-d H:i:s'),
                    'end' => $end->format('y-m-d H:i:s'),

                ]
            );
        }

        return $this->render('accueil/index.html.twig', [
            'filterVehicule' => false,
            'controller_name' => 'AccueilController',
            "v" => $v,
            "agences" => $agence,
        ]);
    }








    // $objetAccueil = new Commande;
    // $form = $this->createForm(AccueilType::class, $objetAccueil);
    // $form->handlerequest($request);
    // $commandes = $repoCommande->findAll();

    // if ($form->isSubmitted() && $form->isValid()) {

    //     $objetAccueil->setDateEnregistrement(new \DateTime());
    //     $manager->persist($objetAccueil);
    //     $manager->flush();
    // }

    // return $this->render('accueil/index.html.twig', [
    //     'controller_name' => 'AccueilController',
    // "formAccueil" => $form->createview(),
    // "dataAccueil" => $objetAccueil

    // ]);

    // return $this->redirectToRoute("app_accueil");




    // #[Route('/membre', name: 'membre_afficher')]
    // public function afficher_ajouter_membre(MembreRepository $repoMembre, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    // {
    //     $objet_membre = new Membre;
    //     $membres = $repoMembre->findAll();


    //     $form = $this->createForm(MembreType::class, $objet_membre);
    //     $form->handleRequest($request);


    //     if ($form->isSubmitted() && $form->isValid()) {

    //         // $hashedPassword = $passwordHasher->hashPassword(
    //         //     $objet_membre,
    //         //     $request->get("membre")["mdp"]
    //         // );

    //         // $objet_membre->setPassword($hashedPassword);
    //         // $repoMembre->save($objet_membre, true);
    //         $objet_membre->setDateEnregistrement(new \DateTime());
    //         $manager->persist($objet_membre);
    //         $manager->flush();

    //         $this->addFlash("Success", "Le membre N° " . $objet_membre->getId() . "a bien été ajouté");
    //     }

    //     return $this->render('membre/membre_afficher.html.twig', [
    //         'controller_name' => 'MembreController',
    //         "formMembre" => $form->createView(),
    //         "membres" => $membres,
    //     ]);
    //     return $this->redirectToRoute("membre_afficher");

    // }



}
