<?php

namespace Gamesites\Payment\Integration\PaySafeCardPayByLink\Response;

use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Operator\AbstractResponseOperator;
use Gamesites\Payment\Operator\ResponseOperatorInterface;

final class ResponseBuilder extends AbstractResponseOperator implements ResponseOperatorInterface
{
    protected array $successfullyStatuses = ['true', true, 'TRUE'];
    protected string $statusField = 'status';

    public function handlePaymentExist(array &$operatorData, HistoryInterface $history): bool
    {
        return $operatorData['hashsha256'] && $this->getHash($operatorData) === $operatorData['hashsha256'];
    }

    private function getHash(array $operatorData): string
    {
        return hash("sha256", $operatorData['secret'] . $this->authOperator->getFieldTwo() . $operatorData['amount']);
    }
}
