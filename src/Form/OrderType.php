<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'surname',
                TextType::class,
                [
                    'required' => false,
                ]
            )
            ->add(
                'patronymic',
                TextType::class,
                [
                    'required' => false,
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'required' => true,
                ]
            )
        ;

        $builder->add(
            'fromAddress',
            TextType::class,
            [
                'required' => true,
            ]
        )
            ->add(
                'fromLatitude',
                TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'fromLongitude',
                TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'fromContactName',
                TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'fromContactPhone',
                TextType::class,
                [
                    'required' => true,
                ]
            )
        ;

        $builder->add(
            'toAddress',
            TextType::class,
            [
                'required' => true,
            ]
        )
            ->add(
                'toLatitude',
                TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'toLongitude',
                TextType::class,
                [
                    'required' => true,
                ]
            )
        ;

        $builder->add(
            'timeBegin',
            DateTimeType::class,
            [
                'required' => true,
            ]
        )
            ->add(
                'timeEnd',
                DateTimeType::class,
                [
                    'required' => true,
                ]
            )
        ;

        $builder->add(
            'schema',
            NumberType::class,
            [
                'required' => false,
            ]
        )
            ->add(
                'legalEntity',
                NumberType::class,
                [
                    'required' => false,
                ]
            )
            ->add(
                'payMethod',
                ChoiceType::class,
                [
                    'required' => true,
                    'choices'  => array_combine(Order::getPayMethods(), Order::getPayMethods()),
                ]
            )
            ->add(
                'externalId',
                TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'tailLift',
                CheckboxType::class,
                [
                    'required' => false,
                ]
            )
            ->add(
                'loaders',
                NumberType::class,
                [
                    'required' => false,
                ]
            )
        ;

        $builder
            ->add(
                'products',
                CollectionType::class,
                [
                    'entry_type'    => ProductType::class,
                    'allow_add'     => true,
                    'allow_delete'  => true,
                    'prototype'     => true,
                    'entry_options' => [
                        'attr' => ['class' => 'product-box'],
                    ],
                ]
            );

        $builder->add(
            'save',
            SubmitType::class,
            [
                'attr' => ['class' => 'save'],
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'      => Order::class,
                'csrf_protection' => false,
            ]
        );
    }
}