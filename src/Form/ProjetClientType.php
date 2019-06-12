<?php

namespace App\Form;

use App\Entity\ProjetClient;
use App\Entity\ProjetClientCategorie;
use App\Entity\ProjetClientQualite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nomClient', TextType::class, [
                'attr' => ['placeholder' => 'Votre nom...']
            ])
            ->add('prenomClient', TextType::class, [
                'attr' => ['placeholder' => 'Votre prenom...']
            ])
            ->add('emailClient', EmailType::class, [
                'attr' => ['placeholder' => 'Votre email...']
            ])
            ->add('dossier', TextType::class, [
                'attr' => ['placeholder' => 'Votre numéro de dossier Berthelot...']
            ])
            ->add('categorie', EntityType::class, [
                'class' => ProjetClientCategorie::class,
                'choice_label' => 'name',
                'placeholder' => 'Choix du pojet :',
                'label' => 'Choix du projet : '

            ])
            ->add('surnomDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Désignation utilisée tout au long du film...']
            ])
            ->add('gender', ChoiceType::class, array(
                'choices' => array('Femme' => 'Femme', 'Homme' => 'Homme'),
                'expanded' => true,
            ))

            ->add('qualite', EntityType::class, [
                'class' => ProjetClientQualite::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choix de la qualité 1 :',
                'label' => 'Choix de la qualité 1 : '

            ])



            ->add('musiques', ChoiceType::class, array(
                'choices' => array('1 - Suite n°3 pour orchestre de Bach' => '1 - Suite n°3 pour orchestre de Bach', '2 - Suite n°3 pour orchestre de Bach' => '2 - Suite n°3 pour orchestre de Bach', '3 - Suite n°3 pour orchestre de Bach' => '3 - Suite n°3 pour orchestre de Bach', '4 - Suite n°3 pour orchestre de Bach' => '4 - Suite n°3 pour orchestre de Bach'),
                'expanded' => false,
                'label' => 'Choisissez la musique qui vous convient le plus pour accompagner votre film hommage'
            ))


            ->add('nomDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Nom...']
            ])

            ->add('prenomDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Prénom...']
            ])
            ->add('dateNaissanceDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Date de naissance...']
            ])
            ->add('dateMortDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Date du décès...']
            ])

            ->add('momentDefunt1', TextType::class, [
                'attr' => ['placeholder' => 'Ex : Son mariage en 1969 ...',
                    'label' => 'Les grands moments de sa vie'
                ]
            ])
            ->add('momentDefunt2', TextType::class, [
                'attr' => ['placeholder' => 'Ex : La naissance de ses enfants ...',
                    'label' => 'Les grands moments de sa vie'
                ]
            ])
            ->add('momentDefunt3', TextType::class, [
                'attr' => ['placeholder' => 'Ex : Son titre de championne ...',
                    'label' => 'Les grands moments de sa vie'
                ]
            ])

            ->add('passionDefunt1', TextType::class, [
                'attr' => ['placeholder' => 'Ex : La lecture ...',
                    'label' => 'Ses passions et hobbies'
                ]
            ])

            ->add('passionDefunt2', TextType::class, [
                'attr' => ['placeholder' => 'Ex : Le jogging ...',
                    'label' => 'Ses passions et hobbies'
                ]
            ])

            ->add('passionDefunt3', TextType::class, [
                'attr' => ['placeholder' => 'Ex : La cuisine ...',
                    'label' => 'Ses passions et hobbies'
                ]
            ])


            ->add('descriptionDefunt', TextareaType::class, [
                'attr' => ['placeholder' => 'Ex : Elle a été une mère exemplaire pour ses enfants ...',
                            'label' => 'Ce que chacun retiendra de lui (en une phrase)...'
                    ]
            ])

            ->add('motFin', TextareaType::class, [
                'attr' => ['placeholder' => 'Repose en paix, Evelyne. Nous ne t\'oublierons jamais ...',
                    'label' => 'CLe mot de la fin'
                ]
            ])

            ->add('deviseDefunt', TextareaType::class, [
                'attr' => ['placeholder' => 'Ex : "Ne jamais baisser les bras"...',
                    'label' => 'devise défunt'
                ]
            ])
            ->add('lieuDefunt', TextareaType::class, [
                'attr' => ['placeholder' => 'Ex : "Un lieu, un paysage, un pays, un village...',
                    'label' => 'lieu défunt'
                ]
            ])


            ->add('save', SubmitType::class, [
                'label' => 'FINALISER',
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
