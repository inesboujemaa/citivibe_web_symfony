<?php

namespace App\Form;

use App\Entity\Avistransport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Avistransport1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avis')
            ->add('note')
            ->add('idt', EntityType::class, [
                'class' => 'App\Entity\transport',
                'choice_label' => 'idt', // Change 'name' to the property you want to display in the dropdown
                'multiple' => false, // Allow multiple selection
                'expanded' => false, // Render as a dropdown (set to true for checkboxes)
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avistransport::class,
        ]);
    }
}
