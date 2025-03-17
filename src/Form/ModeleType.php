<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Employe;
use App\Entity\Modele;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModeleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libel_mod')
            ->add('Nomemp', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('Nomclient', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Modele::class,
        ]);
    }
}
