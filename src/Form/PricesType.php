<?php

namespace App\Form;

use App\Controller\PricesDayController;
use App\Entity\Prices;
use App\Entity\PricesDay;
use App\Entity\PricesGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PricesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price')
            ->add('day', EntityType::class, [
                'class' => PricesDay::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded'=>true
            ])
            ->add('groups', EntityType::class, [
                'class' => PricesGroup::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prices::class,
        ]);
    }
}
