<?php

namespace App\Form;

use App\Entity\Modele;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModeleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('libelle', TextType::class, [
            'label' => 'Libelle',
            'attr' => [
                'placeholder' => 'Libelle',
                'class' => 'form-control',
                'style' => 'margin-bottom: 20px;',
                'autocomplete' => 'off',

            ],
        ])
        
        ->add('save', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => [
                'class' => 'btn btn-primary',
                'style' => 'background-color: #1b1e21; border-color: #1b1e21; margin-top: 20px; margin-bottom: 20px; width: 100%;'


                

            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Modele::class,
        ]);
    }
}
