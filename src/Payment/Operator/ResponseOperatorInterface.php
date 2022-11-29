<?php

namespace Gamesites\Payment\Operator;

use RuntimeException;
use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Enum\PaymentStatusEnum;

interface ResponseOperatorInterface
{
    /** @throws RuntimeException */
    public function getResponse(array $operatorData, HistoryInterface $history): PaymentStatusEnum;

    /** @throws RuntimeException */
    public function handlePaymentExist(array &$operatorData, HistoryInterface $history): bool;
}
