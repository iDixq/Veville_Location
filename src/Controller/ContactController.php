<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(ContactRepository $contact, Request $request, EntityManagerInterface $manager): Response
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', "le message" . $contact->getId() . "a bien été ajoutée");

            return $this->redirectToRoute("afficher_message");
        }

        return $this->render('contact/index.html.twig', [
            "contact" => $contact,
            'formContact' => $form->createView()
        ]);
        return $this->redirectToRoute("afficher_message");
    }

    /**
     * @Route("/contact/afficher", name="afficher_message")
     */
    public function afficher(ContactRepository $repoContact)
    {
        $contacts = $repoContact->findAll();

        return $this->render('contact/message.html.twig', [
            "contacts" => $contacts,
        ]);
        return $this->redirectToRoute("afficher_message");
    }

    /**
     * @Route("/contact/supprimer/{id}", name="delete_message")
     */
    public function delete(Contact $contact, EntityManagerInterface $manager)
    {
        $manager->remove($contact);
        $manager->flush();

        $this->addFlash('success', "l'agence" . $contact->getId() . "a bien été supprimer");
        return $this->redirectToRoute("afficher_message");
    }
}
