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

                'attr' => [
                    
                    'class' => 'form-select'
                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            ->add('ligneId', EntityType::class, [
                'class' => Ligne::class,
                'choice_label' => 'reference',

                'attr' => [
                    
                    'class' => 'form-select'
                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            ->add('terminalId', EntityType::class, [
                'class' => Terminal::class,
                'choice_label' => 'communiquant',

                'attr' => [
                    
                    'class' => 'form-select'
                ],
                // 'block_prefix' => '{{item.Title}}',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary'
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
