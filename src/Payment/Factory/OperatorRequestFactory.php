<?php

namespace Gamesites\Payment\Factory;

use Gamesites\Payment\Enum\OperatorEnum;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Symfony\Component\Form\FormFactory;

class OperatorRequestFactory
{
    private FormFactory $formFactory;

    public function __construct(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function createBuilder(OperatorEnum $operator, string $uri, ?string $statusUri = null): AbstractRequestOperator
    {
        $authClass = 'Gamesites\Payment\Integration\\' . $operator->value . '\AuthOperator';
        $requestBuilderClass = 'Gamesites\Payment\Integration\\' . $operator->value . '\Request\RequestBuilder';

        if (!class_exists($authClass) || !class_exists($requestBuilderClass)) {
            throw new \RuntimeException('Request class of ' . $operator->value . ' does not exist');
        }

        $authOperator = new $authClass();

        return new $requestBuilderClass($this->formFactory, $authOperator, $uri, $statusUri);
    }
}