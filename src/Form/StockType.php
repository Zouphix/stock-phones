<?php

namespace App\Form;

use App\Entity\Stock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => 'Libellé',
                'attr' => [
                    'placeholder' => 'Libellé',
                    'class' => 'form-control',
                    'style' => 'margin-bottom: 20px'
                ]
            ])
            ->add('total', IntegerType::class, [
                'label' => 'Total',
                'attr' => [
                    'placeholder' => 'Total',
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
            'data_class' => Stock::class,
        ]);
    }
}
