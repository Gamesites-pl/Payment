<?php

namespace Gamesites\Payment\Operator;

use Gamesites\Payment\Dto\DetailInterface;
use Gamesites\Payment\Dto\PayerInterface;
use Symfony\Component\Form\FormInterface;
use Gamesites\Payment\Dto\Price;
use Symfony\Component\Form\FormFactoryInterface;

interface RequestOperatorInterface
{
    public function __construct(FormFactoryInterface $formFactory, AbstractAuthOperator $authOperator, string $uri, string $statusUri = null);

    public function getForm(Price|DetailInterface $order, ?PayerInterface $payer = null): FormInterface;
}
