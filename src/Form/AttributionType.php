<?php

namespace App\Form;

use App\Entity\Attribution;
use App\Entity\Employe;
use App\Entity\Ligne;
use App\Entity\Terminal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('employeId', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'Nom',
                'label' => 'Employé',

                'attr' => [
                    
                    'class' => 'form-select',
                    'style' => 'margin-bottom: 20px;'
                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            ->add('ligneId', EntityType::class, [
                'class' => Ligne::class,
                'choice_label' => 'reference',
                'label' => 'Ligne',


                'attr' => [
                    
                    'class' => 'form-select',
                    'style' => 'margin-bottom: 20px;'


                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            ->add('terminalId', EntityType::class, [
                'class' => Terminal::class,
                'choice_label' => 'communiquant',
                'label' => 'Terminal',


                'attr' => [
                    
                    'class' => 'form-select',
                    'style' => 'margin-bottom: 20px;'

                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'background-color: #1b1e21; border-color: #1b1e21; margin-top: 20px; margin-bottom: 20px; width: 100%;'

                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Attribution::class,
        ]);
    }
}
