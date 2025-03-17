<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Employe;
use App\Entity\Mesure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Mesure1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libel_mess')
            ->add('nomclient', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'Nom_cli',
            ])
            ->add('nomemp', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'Nom_emp',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mesure::class,
        ]);
    }
}
