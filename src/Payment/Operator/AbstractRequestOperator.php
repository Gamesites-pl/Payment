<?php

namespace Gamesites\Payment\Operator;

use Gamesites\Payment\Operator\AbstractAuthOperator;
use Symfony\Component\Form\FormFactoryInterface;

abstract class AbstractRequestOperator
{
    protected FormFactoryInterface $formFactory;
    protected string $uri;
    protected string $statusUri;
    protected AbstractAuthOperator $operatorData;

    public function __construct(FormFactoryInterface $formFactory, AbstractAuthOperator $operatorData, string $uri, string $statusUri = null)
    {
        $this->formFactory = $formFactory;
        $this->operatorData = $operatorData;
        $this->uri = $uri;
        $this->statusUri = $statusUri ?: $uri;
    }
}
