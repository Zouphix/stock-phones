<?php

namespace App\Form;

use App\Entity\Forfait;
use App\Entity\Ligne;
use App\Entity\Liste;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, [
                'attr' => [
                    'placeholder' => 'Numero',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;'
                ],
            ])
            ->add('miseService', TextType::class, [
                'attr' => [
                    'placeholder' => 'Date de mise en service',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('finEngagement', TextType::class, [
                'attr' => [
                    'placeholder' => 'Date de fin d\'engagement',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('facturation', TextType::class, [
                'attr' => [
                    'placeholder' => 'Date de facturation',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('portage', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Portage',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('csim', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'CSIM',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('numeroPrive', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Numero prive',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('changementTerminal', TextType::class, [
                'attr' => [
                    'placeholder' => 'Changement terminal',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('modificationForfait', TextType::class, [
                'attr' => [
                    'placeholder' => 'Modification forfait',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('ligneSecondaire', CheckboxType::class, [
                'label' => 'Ligne secondaire : ',
                'attr' => [
                    
                    'class' => 'form-check-input',
                    'style' => 'margin-bottom: 20px;
                                margin-left: 20px;
                                '

                ],
            ])

            ->add('lignePrincipale', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Ligne principale',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])
            ->add('masterIdAcces', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Master ID acces',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px;',
                    'autocomplete' => 'off',

                ],
            ])

            ->add('forfaitId', EntityType::class, [
                'class' => Forfait::class,
                'choice_label' => 'libelle',
                
                'attr' => [
                    'placeholder' => 'Advertisement',
                    'class' => 'form-select',
                    'style' => 'margin-bottom: 20px;'

                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            
            ->add('listeId', EntityType::class, [
                'class' => Liste::class,
                'choice_label' => 'libelle',
                
                'attr' => [
                    'placeholder' => 'User',
                    'class' => 'form-select',
                    'style' => 'margin-bottom: 20px;'

                ],
                // 'block_prefix' => '{{item.Title}}',
                

            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'background-color: #1b1e21; border-color: #1b1e21; margin-top: 20px; margin-bottom: 20px; width: 100%;'
                ],
            ]);
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ligne::class,
        ]);
    }
}
