<?php

namespace Gamesites\Payment\Operator;

use Gamesites\Payment\Operator\AbstractAuthOperator;
use Symfony\Component\Form\FormFactoryInterface;

abstract class AbstractRequestOperator
{
    protected FormFactoryInterface $formFactory;
    protected string $uri;
    protected AbstractAuthOperator $operatorData;

    public function __construct(FormFactoryInterface $formFactory, string $uri, AbstractAuthOperator $operatorData)
    {
        $this->formFactory = $formFactory;
        $this->uri = $uri;
        $this->operatorData = $operatorData;
    }
}
