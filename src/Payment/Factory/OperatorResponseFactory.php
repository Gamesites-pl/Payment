<?php

namespace Gamesites\Payment\Factory;

use Gamesites\Payment\Enum\OperatorEnum;
use Gamesites\Payment\Operator\AbstractRequestOperator;

class OperatorResponseFactory
{
    public function createBuilder(OperatorEnum $operator, string $uri, ?string $statusUri = null): AbstractRequestOperator
    {
        $authClass = 'Gamesites\Payment\Integration\\' . $operator->value . '\AuthOperator';
        $requestBuilderClass = 'Gamesites\Payment\Integration\\' . $operator->value . '\Response\ResponseMapper';

        if (!class_exists($authClass) || !class_exists($requestBuilderClass)) {
            throw new \RuntimeException('Request class of ' . $operator->value . ' does not exist');
        }

        return new $requestBuilderClass(new $authClass());
    }
}
