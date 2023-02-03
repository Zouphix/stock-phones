<?php

namespace App\Form;

use App\Entity\Imprimante;
use App\Entity\Lieu;
use App\Entity\ModeleImprimante;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImprimanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modeleImprimanteId', EntityType::class, [
                'class' => ModeleImprimante::class,
                'choice_label' => 'libelle',
                'label' => 'Modèle de l\'imprimante',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px',
                ]
            ])
            ->add('numSerie', TextType::class, [
                'label' => 'Numéro de série',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px',
                ]
            ])

            ->add('lieuId', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'libelle',
                'label' => 'Lieu de l\'imprimante',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px',
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'background-color: #1b1e21; border-color: #1b1e21; margin-top: 20px; margin-bottom: 20px; width: 100%;'

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Imprimante::class,
        ]);
    }
}
