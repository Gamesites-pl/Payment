<?php

namespace Gamesites\Payment\Integration\HotPay\Response;

use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Operator\AbstractResponseOperator;
use Gamesites\Payment\Operator\ResponseOperatorInterface;

class ResponseBuilder extends AbstractResponseOperator implements ResponseOperatorInterface
{
    protected array $successfullyStatuses = ['SUCCESS'];
    protected string $statusField = 'STATUS';

    public function handlePaymentExist(array &$operatorData, HistoryInterface $history): bool
    {
        return $operatorData['HASH'] && $this->getHash($operatorData) === $operatorData['HASH'];
    }

    private function getHash(array $operatorData): string
    {
        return hash(
            'sha256',
            $this->authOperator->getFieldTwo() . ';'
            . ($operatorData['KWOTA'] ?? '') . ';'
            . ($operatorData['ID_PLATNOSCI'] ?? '') . ';'
            . $operatorData['ID_ZAMOWIENIA'] . ';'
            . ($operatorData['STATUS'] ?? '') . ';'
            . ($operatorData['SEKRET'] ?? '')
        );
    }
}
