<?php

namespace Gamesites\Payment\Integration\MicroSMS\Response;

use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Operator\AbstractResponseOperator;
use Gamesites\Payment\Operator\ResponseOperatorInterface;

final class ResponseBuilder extends AbstractResponseOperator implements ResponseOperatorInterface
{
    protected array $successfullyStatuses = ['true', true, 'TRUE'];
    protected string $statusField = 'status';

    public function handlePaymentExist(array &$operatorData, HistoryInterface $history): bool
    {
        return $operatorData[$this->statusField] && $history;
    }
}
