<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Fournisseur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('design_fou')
            ->add('tel_fou')
            ->add('Noem_emp', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'nom_emp',
                'multiple' => true,
                'attr' => ['class' => 'select2'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fournisseur::class,
        ]);
    }
}
