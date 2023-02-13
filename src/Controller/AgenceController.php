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

     /**
     * @Route("/agence/update/{id}", name="update_agence")
     */
    public function update(Agence $agence, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($agence);
            $manager->flush();
    
            $this->addFlash('success', "l'agence N" . $agence->getId() ."a bien été modifiée");

            return $this->redirectToRoute("app_agence");
        }

        return $this->render("agence/update_agence.html.twig", [
            "formAgence" => $form->createView(),
            "agence" => $agence
        ]);
    }
    
      /**
     * @Route("/agence/supprimer/{id}", name="delete_agence")
     */
    public function delete(Agence $agence, EntityManagerInterface $manager)
    {
        $manager->remove($agence);
        $manager->flush();

        $this->addFlash('success',"l'agence" . $agence->getId() . "a bien été supprimer");
        return $this->redirectToRoute("app_agence");
    }

        /**
     * @Route("/agence/detail/{id}", name="detail_agence")
     */
    public function detail(Agence $agence, EntityManagerInterface $manager, AgenceRepository $repoAgence, $id)
    {
        $agence = $repoAgence->find($id);

        return $this->render('agence/detail_agence.html.twig', [
            "agence" => $agence,
        ]);
        return $this->redirectToRoute("detail_agence");
    }
}
