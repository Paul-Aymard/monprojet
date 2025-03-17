<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Fournisseur;
use App\Entity\Tissu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TissuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libel_tiss')
            // ->add('clients', EntityType::class, [
            //     'class' => Client::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            ->add('Design_fou', EntityType::class, [
                'class' => Fournisseur::class,
                    'choice_label' => 'Design_fou',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tissu::class,
        ]);
    }
}
