<?php

namespace Gamesites\Payment\Integration\HotPay;

use http\Exception\RuntimeException;
use Gamesites\Payment\Operator\AbstractAuthOperator;

class AuthOperator extends AbstractAuthOperator
{
    public function validate()
    {
        if (!$this->fieldOne) {
            throw new RuntimeException('This field is required and should be set as SEKRET');
        }
        if (!$this->fieldTwo) {
            throw new RuntimeException('This field is required and should be set as HASH');
        }
    }
}
