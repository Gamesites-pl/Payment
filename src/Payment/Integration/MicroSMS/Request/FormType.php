<?php

namespace Gamesites\Payment\Integration\MicroSMS\Request;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class FormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shopid', HiddenType::class)
            ->add('signature', HiddenType::class)
            ->add('amount', HiddenType::class)
            ->add('control', HiddenType::class)
            ->add('return_urlc', HiddenType::class)
            ->add('return_url', HiddenType::class)
            ->add('test', HiddenType::class);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'csrf_protection' => false,
                'action' => 'https://microsms.pl/api/bankTransfer/',
                'method' => 'GET',
            ]);
    }
}
