<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\AgenceType;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class VehiculeController extends AbstractController
{  
    /**
     * @Route("/vehicule", name="app_vehicule")
     */
    public function index(VehiculeRepository $repoVehicule, Request $request, EntityManagerInterface $manager): Response
    {
        $vehicule = new Vehicule;
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        $vehicules = $repoVehicule->findAll();
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($vehicule);
            $manager->flush();

            $this->addFlash('success', "le vehicule" . $vehicule->getId() ."a bien été ajoutée");

            return $this->redirectToRoute("app_vehicule");
        }

        return $this->render('vehicule/index.html.twig', [
            "vehicules" => $vehicules,
            "formVehicule" => $form->createView()
        ]);
    }

     /**
     * @Route("/vehicule/update/{id}", name="update_vehicule")
     */
    public function update(Vehicule $vehicule, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($vehicule);
            $manager->flush();
    
            $this->addFlash('success', "le vehicule" . $vehicule->getId() ."a bien été modifiée");

            return $this->redirectToRoute("app_vehicule");
        }

        return $this->render("vehicule/update_vehicule.html.twig", [
            "formVehicule" => $form->createView(),
            "vehicule" => $vehicule
        ]);
    }

    /**
     * @Route("/vehicule/supprimer/{id}", name="delete_vehicule")
     */
    public function delete(Vehicule $vehicule, EntityManagerInterface $manager)
    {
        $manager->remove($vehicule);
        $manager->flush();

        $this->addFlash('success', "le vehicule" . $vehicule->getId() . "a bien été supprimer");
        return $this->redirectToRoute("app_vehicule");
    }

        /**
     * @Route("/vehicule/detail/{id}", name="detail_vehicule")
     */
    public function detail(vehicule $vehicule, EntityManagerInterface $manager, VehiculeRepository $repoVehicule, $id)
    {
        $vehicule = $repoVehicule->find($id);

        return $this->render('vehicule/detail_vehicule.html.twig', [
            "vehicule" => $vehicule,
        ]);
        return $this->redirectToRoute("detail_vehicule");
    }
}


