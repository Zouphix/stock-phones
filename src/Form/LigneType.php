<?php

namespace App\Form;

use App\Entity\Forfait;
use App\Entity\Ligne;
use App\Entity\Liste;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('reference', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Numero',
                    'class' => 'form-control'
                ],
            ])
            ->add('miseService', TextType::class, [
                'attr' => [
                    'placeholder' => 'Date de mise en service',
                    'class' => 'form-control'
                ],
            ])
            ->add('finEngagement', TextType::class, [
                'attr' => [
                    'placeholder' => 'Date de fin d\'engagement',
                    'class' => 'form-control'
                ],
            ])
            ->add('facturation', TextType::class, [
                'attr' => [
                    'placeholder' => 'Date de facturation',
                    'class' => 'form-control'
                ],
            ])
            ->add('portage', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Portage',
                    'class' => 'form-control'
                ],
            ])
            ->add('csim', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'CSIM',
                    'class' => 'form-control'
                ],
            ])
            ->add('numeroPrive', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Numero prive',
                    'class' => 'form-control'
                ],
            ])
            ->add('changementTerminal', TextType::class, [
                'attr' => [
                    'placeholder' => 'Changement terminal',
                    'class' => 'form-control'
                ],
            ])
            ->add('modificationForfait', TextType::class, [
                'attr' => [
                    'placeholder' => 'Modification forfait',
                    'class' => 'form-control'
                ],
            ])
            ->add('ligneSecondaire')
            ->add('lignePrincipale', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Ligne principale',
                    'class' => 'form-control'
                ],
            ])
            ->add('masterIdAcces', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Master ID acces',
                    'class' => 'form-control'
                ],
            ])

            ->add('forfaitId', EntityType::class, [
                'class' => Forfait::class,
                'choice_label' => 'libelle',
                
                'attr' => [
                    'placeholder' => 'Advertisement',
                    'class' => 'form-select'
                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            
            ->add('listeId', EntityType::class, [
                'class' => Liste::class,
                'choice_label' => 'libelle',
                
                'attr' => [
                    'placeholder' => 'User',
                    'class' => 'form-select'
                ],
                // 'block_prefix' => '{{item.Title}}',
                

            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create',
                'attr' => [
                    'class' => 'btn btn-primary'
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
