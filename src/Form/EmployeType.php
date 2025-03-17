<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Fournisseur;
use App\Entity\Modele;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_emp')
            ->add('Pre_emp')
            ->add('tel_emp')
            // ->add('modeles', EntityType::class, [
            //     'class' => Modele::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            // ->add('fournisseurs', EntityType::class, [
            //     'class' => Fournisseur::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
