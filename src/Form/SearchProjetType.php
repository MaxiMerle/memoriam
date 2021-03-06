<?php

namespace App\Form;

use App\Entity\ProjetClient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomClient', TextType::class,[
                'label' => 'Votre nom',
            ])

            ->add('emailClient', TextType::class,[
                'label' => 'Votre email',
            ])
            ->add('code', TextType::class,[
                'label' => 'Votre code à 9 chiffres fourni chez Berthelot',

            ])
            ->add('save', SubmitType::class, [
                'label' => 'CHERCHER',
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