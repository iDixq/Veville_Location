<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                "label" => "Pseudo",
                "required" => true,
                "attr" => [
                    "placeholder" => "pseudo",
                    "class" => "form-control"
                ]

            ])
            ->add('mdp', PasswordType::class, [
                "label" => "Mot de passe",
                "required" => true,
                "attr" => [
                    "placeholder" => "mot de passe",
                    "class" => "form-control"
                ]
            ])
            ->add('nom', TextType::class, [
                "label" => "Nom",
                "required" => true,
                "attr" => [
                    "placeholder" => "nom",
                    "class" => "form-control"
                ]
            ])
            ->add('prenom', TextType::class, [
                "label" => "Prénom",
                "required" => true,
                "attr" => [
                    "placeholder" => "prenom",
                    "class" => "form-control"
                ]
            ])
            ->add('email', EmailType::class, [
                "label" => "Email",
                "required" => true,
                "attr" => [
                    "placeholder" => "email",
                    "class" => "form-control"
                ]
            ])
            ->add('civilite', TextType::class, [
                "label" => "Civilite",
                "required" => true,
                "attr" => [
                    "placeholder" => "Civilite",
                    "class" => "form-control"
                ]
            ])
            ->add('statut', NumberType::class, [
                "label" => "Statut",
                "required" => true,
                "attr" => [
                    "placeholder" => "Statut",
                    "class" => "form-control"
                ]

            ])
            ->add('date_enregistrement', DateType::class, [
                'widget' => 'choice',
                'input'  => 'datetime_immutable',
                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
