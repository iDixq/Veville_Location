<?php

namespace App\Form;

use App\Entity\Vehicule;
use App\Entity\Agence;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'titre',
                'required' => false,
                "attr" => [
                    "placeholder" => "titre",
                    "class" => "form-control"
                ]
            ])
            ->add('marque', TextType::class, [
                'label' => 'marque',
                'required' => false,
                "attr" => [
                    "placeholder" => "marque",
                    "class" => "form-control"
                ]
            ])
            ->add('modele', TextType::class, [
                'label' => 'modele',
                'required' => false,
                "attr" => [
                    "placeholder" => "modele",
                    "class" => "form-control"
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'description',
                'required' => false,
                "attr" => [
                    "placeholder" => "description",
                    "class" => "form-control"
                ]
            ])
            ->add('photo', TextType::class, [
                "label" => "Photo",
                "required" => false,
                "attr" => [
                    "placeholder" => "photo",
                    "class" => "form-control"
                ]
            ])
            ->add('prix_journalier', NumberType::class, [
                "label" => "prix_journalier",
                "required" => false,
                "attr" => [
                    "placeholder" => "prix_journalier",
                    "class" => "form-control"
                ]
            ])
            ->add('id_agence', EntityType::class, [

                'class' => Agence::class,
                'choice_label' => 'titre',

            ])
            ->add('Ajouter', SubmitType::class);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
