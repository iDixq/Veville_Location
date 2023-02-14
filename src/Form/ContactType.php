<?php

namespace App\Form;

use App\Entity\Contact;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                "label" => "email",
                "required" => false,
                "attr" => [
                    "placeholder" => "email",
                    "class" => "form-control"
                ]
            ])
            ->add('message', TextareaType::class, [
                "label" => "message",
                "required" => false,
                "attr" => [
                    "placeholder" => "message",
                    "class" => "form-control"
                ]
            ])
            ->add('Envoyer', SubmitType::class);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
