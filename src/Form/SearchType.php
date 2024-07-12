<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // $builder
        //     ->add('field_name')
        // ;
        $builder
        ->add('artistQuery', TextType::class, [
            'label' => 'Recherche d\'artiste',
            'required' => false, // Champ non obligatoire
            'attr' => [
                'placeholder' => 'Rechercher un artiste...',
                'class' => 'form-control-sm mr-sm-2',
            ],
        ])
        ->add('discQuery', TextType::class, [
            'label' => 'Recherche de disque',
            'required' => false, // Champ non obligatoire
            'attr' => [
                'placeholder' => 'Rechercher un disque...',
                'class' => 'form-control-sm mr-sm-2',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
