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
                ,
                'required' => false
            ])
            ->add('prenomClient', TextType::class, [
                'attr' => ['placeholder' => 'Votre prenom...'],
                'required' => false
            ])
            ->add('emailClient', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Votre email...',
                    'readonly' => true
                    ],
                'required' => false,

            ])

            ->add('surnomDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Dénomination utilisée tout au long du film...'],
                'required' => false
            ])
            ->add('gender', ChoiceType::class, array(
                'choices' => array('Femme' => 'Femme', 'Homme' => 'Homme'),
                'expanded' => true,
            ))



            ->add('qualite1', TextType::class, [
                'attr' => ['placeholder' => 'Qualité 1'],
                'required' => false
            ])
            ->add('qualite2', TextType::class, [
                'attr' => ['placeholder' => 'Qualité 2'],
                'required' => false
            ])
            ->add('qualite3', TextType::class, [
                'attr' => ['placeholder' => 'Qualité 3'],
                'required' => false
            ])



            ->add('musiques', ChoiceType::class, array(
                'choices' => array('Suite n°3 pour orchestre de Bach' => 'Suite n°3 pour orchestre de Bach', 'Suite n°4 pour orchestre de Bach' => 'Suite n°4 pour orchestre de Bach', 'Suite n°5 pour orchestre de Bach' => 'Suite n°5 pour orchestre de Bach', 'Suite n°6 pour orchestre de Bach' => 'Suite n°6 pour orchestre de Bach', 'Suite n°7 pour orchestre de Bach' => 'Suite n°7 pour orchestre de Bach', 'Suite n°8 pour orchestre de Bach' => 'Suite n°8 pour orchestre de Bach'),
                'expanded' => true,
                'attr' => ['class' => 'col-12']


            ))


            ->add('nomDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Nom...'],
                'required' => false
            ])

            ->add('prenomDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Prénom...'],
                'required' => false
            ])
            ->add('dateNaissanceDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Date de naissance...'],
                'required' => false
            ])
            ->add('dateMortDefunt', TextType::class, [
                'attr' => ['placeholder' => 'Date du décès...'],
                'required' => false
            ])

            ->add('momentDefunt1', TextType::class, [
                'attr' => ['placeholder' => 'Ex : Son mariage en 1969 ...',
                    'label' => 'Les grands moments de sa vie'
                ]
                ,
                'required' => false
            ])
            ->add('momentDefunt2', TextType::class, [
                'attr' => ['placeholder' => 'Ex : La naissance de ses enfants ...',
                    'label' => 'Les grands moments de sa vie'
                ],
                'required' => false
            ])
            ->add('momentDefunt3', TextType::class, [
                'attr' => ['placeholder' => 'Ex : Son titre de championne ...',
                    'label' => 'Les grands moments de sa vie'
                ],
                'required' => false
            ])

            ->add('passionDefunt1', TextType::class, [
                'attr' => ['placeholder' => 'Ex : La lecture ...',
                    'label' => 'Ses passions ses hobbies'
                ],
                'required' => false
            ])

            ->add('passionDefunt2', TextType::class, [
                'attr' => ['placeholder' => 'Ex : Le jogging ...',
                    'label' => 'Ses passions ses hobbies'
                ],
                'required' => false
            ])

            ->add('passionDefunt3', TextType::class, [
                'attr' => ['placeholder' => 'Ex : La cuisine ...',
                    'label' => 'Ses passions ou ses hobbies'
                ],
                'required' => false
            ])


            ->add('descriptionDefunt', TextareaType::class, [
                'attr' => ['placeholder' => 'Ex : Elle a été une mère exemplaire pour ses enfants ...',
                            'label' => 'Ce que chacun retiendra de lui (en une phrase)...'
                    ],
                'required' => false
            ])

            ->add('motFin', TextareaType::class, [
                'attr' => ['placeholder' => 'Ex : Repose en paix, Evelyne. Nous ne t\'oublierons jamais ...',
                    'label' => 'épitaphe'
                ],
                'required' => false
            ])

            ->add('deviseDefunt', TextareaType::class, [
                'required'          => false,
                'attr' => ['placeholder' => 'Ex : "Ne jamais baisser les bras"...',
                    'label' => 'devise défunt'
                ],
            ])
            ->add('lieuDefunt', TextareaType::class, [
                'required'          => false,
                'attr' => [
                    'placeholder' => 'Ex : "Le vieux port de Marseille, la Forêt des Landes, les chateaux de la Loire...',
                    'label' => 'lieu défunt',

                ],
            ])


            ->add('save', SubmitType::class, [
                'label' => 'VALIDER',
                'attr' => [
                    'class' => 'btn btn-block btn-outline-success',


                    ]
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
