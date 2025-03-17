<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Employe;
use App\Entity\Modele;
use App\Entity\Vetement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VetementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libel_vet')
            ->add('Nom_emp', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'Nom_emp',
            ])
            ->add('Libel_mod', EntityType::class, [
                'class' => Modele::class,
                'choice_label' => 'Libel_mod',
            ])
            ->add('Nomcli', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'Nomcli',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vetement::class,
        ]);
    }
}
