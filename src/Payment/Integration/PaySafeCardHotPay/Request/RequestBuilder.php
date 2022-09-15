<?php

namespace Gamesites\Payment\Integration\PaySafeCardHotPay\Request;

use Gamesites\Payment\Integration\HotPay\Request\RequestBuilder as HotPayRequestBuilder;
use Gamesites\Payment\Operator\RequestOperatorInterface;

final class RequestBuilder extends HotPayRequestBuilder implements RequestOperatorInterface
{
    protected const FORM_TYPE = FormType::class;
}
