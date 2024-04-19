<?php

namespace App\Form;

use App\Entity\Avistransport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NouvelAvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avis', TextareaType::class, [
                'label' => 'Votre avis',
                'required' => false, // Le champ n'est pas obligatoire
            ])
            ->add('note', TextType::class, [
                'label' => 'Votre note (sur 5)',
                'required' => false, // Le champ n'est pas obligatoire
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avistransport::class,
        ]);
    }
}
