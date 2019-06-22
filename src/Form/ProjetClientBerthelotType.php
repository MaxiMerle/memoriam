<?php

namespace App\Form;

use App\Entity\ProjetClient;
use App\Entity\ProjetClientCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetClientBerthelotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomClient')
            ->add('emailClient')

            ->add('categorie', EntityType::class, [
                'class' => ProjetClientCategorie::class,
                'choice_label' => 'name',
                'placeholder' => 'Projet selectionné :',
                'label' => 'Projet'

            ])            ->add('save', SubmitType::class, [
                'label' => 'VALIDER',
                'attr' => ['class' => 'btn btn-block btn-outline-success']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjetClient::class,
        ]);
    }
}
