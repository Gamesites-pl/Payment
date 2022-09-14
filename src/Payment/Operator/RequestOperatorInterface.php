<?php

namespace Gamesites\Payment\Operator;

use Gamesites\Payment\Dto\DetailInterface;
use Symfony\Component\Form\FormInterface;
use Gamesites\Payment\Dto\PriceInterface;
use Gamesites\Payment\Operator\AbstractAuthOperator;
use Symfony\Component\Form\FormFactoryInterface;

interface RequestOperatorInterface
{
    public function __construct(FormFactoryInterface $formFactory, AbstractAuthOperator $authOperator, string $uri, string $statusUri = null);

    public function getForm(array $requestData, PriceInterface|DetailInterface $order): FormInterface;
}
