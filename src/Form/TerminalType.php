<?php

namespace App\Form;

use App\Entity\Modele;
use App\Entity\Terminal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TerminalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        
        
        $builder
            ->add('achete', EntityType::class, [
                'class' => Modele::class,
                'choice_label' => 'libelle',
                'label' => 'Modèle du terminal acheté',

                'attr' => [
                    
                    'class' => 'form-select',
                    'style' => 'margin-bottom: 20px;'
                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            ->add('communiquant', EntityType::class, [
                'class' => Modele::class,
                'choice_label' => 'libelle',
                'label' => 'Modèle du terminal communiquant',

                'attr' => [
                    
                    'class' => 'form-select',
                    'style' => 'margin-bottom: 20px;'
                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            ->add('imeiAchete', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'IMEI du terminal acheté',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('imeiCommuniquant', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'IMEI du terminal communiquant',
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
            'data_class' => Terminal::class,
        ]);
    }
}
