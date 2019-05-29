<?php

namespace App\Form;

use App\Entity\ProjetClient;
use App\Entity\ProjetClientCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nomClient')
            ->add('prenomClient')
            ->add('emailClient')
            ->add('dossier')
            ->add('categorie', EntityType::class, [
                'class' => ProjetClientCategorie::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisissez votre forfait',
                'label' => 'Choix du forfait'
            ])

            ->add('nomDefunt')
            ->add('prenomDefunt')
            ->add('dateNaissanceDefunt')
            ->add('dateMortDefunt')
            ->add('descriptionDefunt')


            ->add('save', SubmitType::class, [
                'label' => 'FINALISER',
                'attr' => ['class' => 'btn btn-block btn-outline-success']
                ])

        ;
    }
    public function buildFormDefunt(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nomDefunt')
            ->add('prenomDefunt')
            ->add('dateNaissanceDefunt')
            ->add('dateMortDefunt')
            ->add('descriptionDefunt')
            ->add('save', SubmitType::class, [
                'label' => 'Valider les informations du défunt et passer à la suite >>',
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
