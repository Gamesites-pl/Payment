<?php

namespace Gamesites\Payment\Integration\TPay\Request;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class FormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('amount', HiddenType::class)
            ->add('description', HiddenType::class)
            ->add('crc', HiddenType::class)
            ->add('md5sum', HiddenType::class)
            ->add('return_url', HiddenType::class);
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
                'action' => 'https://secure.tpay.com',
                'method' => 'GET',
            ]);
    }
}
