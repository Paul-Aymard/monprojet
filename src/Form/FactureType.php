<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Employe;
use App\Entity\Facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dat_factAt', null, [
                'widget' => 'single_text',
            ])
            ->add('mont_fact')
            ->add('Nom_emp', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'Nom_emp',
            ])
            ->add('nom_cli', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'nom_cli',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
