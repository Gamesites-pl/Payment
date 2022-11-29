<?php

namespace Gamesites\Payment\Integration\Przelewy24;

use http\Exception\RuntimeException;
use Gamesites\Payment\Operator\AbstractAuthOperator;

class AuthOperator extends AbstractAuthOperator
{
    public function validate()
    {
        if (!$this->fieldOne) {
            throw new RuntimeException('This field is required and should be set as merchantId, posId -> shop ID');
        }
        if (!$this->fieldTwo) {
            throw new RuntimeException('This field is required and should be set as secretId -> API Key, Report Key');
        }
        if (!$this->fieldThree) {
            throw new RuntimeException('This field is required and should be set as crc -> Cyclic Redundancy Check');
        }
    }
}
