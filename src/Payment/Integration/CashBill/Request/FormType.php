<?php

namespace Gamesites\Payment\Integration\CashBill\Request;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class FormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('service', HiddenType::class)
            ->add('amount', HiddenType::class)
            ->add('desc', HiddenType::class)
            ->add('userdata', HiddenType::class)
            ->add('sign', HiddenType::class);
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
                'action' => 'https://www.cashbill.pl/cblite/pay.php',
                'method' => 'POST',
            ]);
    }
}
