<?php

namespace Gamesites\Payment\Operator;

use Symfony\Component\Form\FormFactoryInterface;

abstract class AbstractRequestOperator
{
    protected FormFactoryInterface $formFactory;
    protected AbstractAuthOperator $authOperator;
    protected string $uri;
    protected string $statusUri;

    public function __construct(FormFactoryInterface $formFactory, AbstractAuthOperator $authOperator, string $uri, string $statusUri = null)
    {
        $this->formFactory = $formFactory;
        $this->authOperator = $authOperator;
        $this->uri = $uri;
        $this->statusUri = $statusUri ?: $uri;
    }
}
