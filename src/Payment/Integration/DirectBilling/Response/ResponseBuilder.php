<?php

namespace Gamesites\Payment\Integration\DirectBilling\Response;

use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Operator\AbstractResponseOperator;
use Gamesites\Payment\Operator\ResponseOperatorInterface;

final class ResponseBuilder extends AbstractResponseOperator implements ResponseOperatorInterface
{
    protected array $successfullyStatuses = [1, '1'];
    protected string $statusField = 'STATUS';

    public function handlePaymentExist(array $operatorData, HistoryInterface $history): bool
    {
        return $operatorData[$this->statusField] && $history;
    }
}
