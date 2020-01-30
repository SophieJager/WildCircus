<?php

namespace App\Form;

use App\Entity\Prices;
use App\Entity\PricesGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PricesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groups', EntityType::class, [
                'class' => PricesGroup::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded'=>true
            ])
            ->add('priceWeek')
            ->add('priceWeekEnd')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prices::class,
        ]);
    }
}
