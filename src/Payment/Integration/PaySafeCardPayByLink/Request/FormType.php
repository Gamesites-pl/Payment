<?php

namespace Gamesites\Payment\Integration\PaySafeCardPayByLink\Request;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class FormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userid', HiddenType::class)
            ->add('shopid', HiddenType::class)
            ->add('amount', HiddenType::class)
            ->add('return_ok', HiddenType::class)
            ->add('return_fail', HiddenType::class)
            ->add('url', HiddenType::class)
            ->add('control', HiddenType::class)
            ->add('hash', HiddenType::class)
            ->add('description', HiddenType::class);
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
                'action' => 'https://www.rushpay.pl/api/psc/',
                'method' => 'POST',
            ]);
    }
}
