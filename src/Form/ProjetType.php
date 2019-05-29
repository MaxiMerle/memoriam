<?php
namespace App\Form;
use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dossier')
            ->add('NomDefunt')
            ->add('PrenomDefunt')
            ->add('DateNaissance'/*, DateType::class, [
'label' => 'Date de naissance du défunt',
'widget' => 'single_text',
// prevents rendering it as type="date", to avoid HTML5 date pickers
'html5' => false,
// adds a class that can be selected in JavaScript
'attr' => ['class' => 'js-datepicker'],
'format' => 'DD MM YY'
]*/)


            /*  ->add('projetFile', CollectionType::class, array(
                  'entry_type'   => ProjetFiles::class,
                  'allow_add'    => true,
              ));

            */
            ->add('DateMort')
            ->add('imageFile',VichImageType::class,[
                'attr' => [
                    'class' => 'label-drop icon btn-drop'
                ]
            ])
            ->add('save', SubmitType::class)

        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
