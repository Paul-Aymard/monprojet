<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Modele;
use App\Entity\Tissu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_cli',
            //  TextType::class, [
                // 'attr' => [
                //     'class'=> "form-control" ,
                //     'placeholder' => "Nom du client"
                // ] ]
                )
            ->add('Pre_cli')
            ->add('Tel_cli')
            ->add('Sex_cli')
            // ->add('modeles', EntityType::class, [
            //     'class' => Modele::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            // ->add('libel_tisss', EntityType::class, [
            //     'class' => Tissu::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
