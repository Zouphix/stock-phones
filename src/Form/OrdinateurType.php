<?php

namespace App\Form;

use App\Entity\Ordinateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdinateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numSerie', TextType::class, [
                'label' => 'Numéro de série',
                'attr' => [
                    'placeholder' => 'Numéro de série',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            ->add('expirationGarantie', TextType::class, [
                'label' => 'Expiration de la garantie',
                'attr' => [
                    'placeholder' => 'Expiration de la garantie',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            ->add('ip', TextType::class, [
                'label' => 'Adresse IP',
                'attr' => [
                    'placeholder' => 'Adresse IP',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            ->add('domaine', TextType::class, [
                'label' => 'Domaine',
                'attr' => [
                    'placeholder' => 'Domaine',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            ->add('commentaire', TextType::class, [
                'label' => 'Commentaire',
                'attr' => [
                    'placeholder' => 'Commentaire',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            ->add('employeId', EntityType::class, [
                'class' => 'App\Entity\Employe',
                'choice_label' => 'nom',
                'label' => 'Employé',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            ->add('modeleOrdinateurId', EntityType::class, [
                'class' => 'App\Entity\ModeleOrdinateur',
                'choice_label' => 'libelle',
                'label' => 'Modèle',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            ->add('lieuId', EntityType::class, [
                'class' => 'App\Entity\Lieu',
                'choice_label' => 'libelle',
                'label' => 'Lieu',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            // ->add('statutId', EntityType::class, [
            //     'class' => 'App\Entity\Statut',
            //     'choice_label' => 'libelle',
            //     'label' => 'Statut',
            //     'attr' => [
            //         'class' => 'form-control',
            //         'style' => 'margin-bottom: 20px'
            //     ]
            // ])
            ->add('typeId', EntityType::class, [
                'class' => 'App\Entity\Type',
                'choice_label' => 'libelle',
                'label' => 'Type',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'style' => 'background-color: #1b1e21; border-color: #1b1e21; margin-top: 20px; margin-bottom: 20px; width: 100%;'

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ordinateur::class,
        ]);
    }
}
