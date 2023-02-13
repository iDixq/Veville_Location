<?php

namespace App\Form;

use App\Entity\Agence;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                "label" => "Titre",
                "required" => false,
                "attr" => [
                    "placeholder" => "titre",
                    "class" => "form-control"
                ]
            ]) 
            ->add('adresse', TextType::class,[
                "label" => "Adresse",
                "required" => false,
                "attr" => [
                    "placeholder" => "adresse",
                    "class" => "form-control"
                ]
            ])
            ->add('ville', TextType::class,[
                "label" => "Ville",
                "required" => false,
                "attr" => [
                    "placeholder" => "ville",
                    "class" => "form-control"
                ]
            ])
            ->add('cp', NumberType::class,[
                "label" => "Code-postal",
                "required" => false,
                "attr" => [
                    "placeholder" => "cp",
                    "class" => "form-control"
                ]
            ])
            ->add('description', TextareaType::class,[
                "label" => "Description",
                "required" => false,
                "attr" => [
                    "placeholder" => "description",
                    "class" => "form-control"
                ]
            ])
            ->add('photo', TextType::class,[
                "label" => "Photo",
                "required" => false,
                "attr" => [
                    "placeholder" => "photo",
                    "class" => "form-control"
                ]
            ])
            ->add('Ajouter',SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agence::class,
        ]);
    }
}
