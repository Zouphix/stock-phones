<?php

namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame',
                    'Mademoiselle' => 'Mademoiselle',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;'
                ],
            ])
            ->add('Nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;autocomplete:off',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('Prenom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prenom',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',


                ],
            ])
            ->add('Email', TextType::class, [
                'attr' => [
                    'placeholder' => 'Email',
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
            'data_class' => Employe::class,
        ]);
    }
}
