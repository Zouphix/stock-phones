<?php

namespace App\Form;

use App\Entity\Moniteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoniteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numSerie', TextType::class, [
                'label' => 'Numéro de série',
                'attr' => [
                    'placeholder' => 'Numéro de série',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px',
                ],
            ])
            ->add('commentaire', TextType::class, [
                'label' => 'Commentaire',
                'attr' => [
                    'placeholder' => 'Commentaire',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px',

                ],
            ])
            ->add('modeleMoniteurId', EntityType::class, [
                'class' => 'App\Entity\ModeleMoniteur',
                'choice_label' => 'libelle',
                'label' => 'Modèle',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px',

                ],
            ])
            ->add('lieuId', EntityType::class, [
                'class' => 'App\Entity\Lieu',
                'choice_label' => 'libelle',
                'label' => 'Lieu',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px',

                ],
            ])
            ->add('submit', SubmitType::class, [
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
            'data_class' => Moniteur::class,
        ]);
    }
}
