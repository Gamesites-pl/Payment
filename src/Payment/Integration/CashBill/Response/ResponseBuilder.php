<?php

namespace Gamesites\Payment\Integration\CashBill\Response;

use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Operator\AbstractResponseOperator;
use Gamesites\Payment\Operator\ResponseOperatorInterface;

final class ResponseBuilder extends AbstractResponseOperator implements ResponseOperatorInterface
{
    protected array $successfullyStatuses = ['OK', 'ok'];
    protected string $statusField = 'status';

    public function handlePaymentExist(array &$operatorData, HistoryInterface $history): bool
    {
        return $operatorData['sign'] && $this->getHash($operatorData) === $operatorData['sign'];
    }

    private function getHash(array $operatorData): string
    {
        return md5($operatorData['service'] . $operatorData['orderid'] . $operatorData['amount'] . $operatorData['userdata'] . $operatorData[$this->statusField] . $this->authOperator->getFieldTwo());
    }
}
