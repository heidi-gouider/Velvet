<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Disc;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', options:['label' => 'Titre'])
            ->add('picture')
            ->add('prix')
            ->add('label')
            ->add('quantite')
            ->add('vente')
            ->add('year', options:['label' => 'Année'])
            ->add('genre')
            ->add('artist', EntityType::class, [
                'class' => Artist::class,
                // 'choice_label' => 'id',
                'choice_label' => 'name',

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Disc::class,
        ]);
    }
}
