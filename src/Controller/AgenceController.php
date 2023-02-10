<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Form\AgenceType;
use App\Repository\AgenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AgenceController extends AbstractController
{
    /**
     * @Route("/agence", name="app_agence")
     */
    public function index(AgenceRepository $repoAgence, Request $request, EntityManagerInterface $manager): Response
    {
        $agence = new Agence;
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);
        $agences = $repoAgence->findAll();
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($agence);
            $manager->flush();

            $this->addFlash('success', "l'agence' N" . $agence->getId() ."a bien été ajoutée");

            return $this->redirectToRoute("app_agence");
        }

      
        return $this->render('agence/index.html.twig', [
          "agences" => $agences,
          "formAgence" => $form->createView()
        ]);
    }

}
