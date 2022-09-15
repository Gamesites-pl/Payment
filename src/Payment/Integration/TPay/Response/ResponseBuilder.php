<?php

namespace Gamesites\Payment\Integration\TPay\Response;

use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Operator\AbstractResponseOperator;
use Gamesites\Payment\Operator\ResponseOperatorInterface;

final class ResponseBuilder extends AbstractResponseOperator implements ResponseOperatorInterface
{
    protected array $successfullyStatuses = ['TRUE', 'PAID', true, 'true'];
    protected string $statusField = 'tr_status';
    public const RESPONSE = 'TRUE';

    public function handlePaymentExist(array $operatorData, HistoryInterface $history): bool
    {
        return $operatorData['md5sum'] && $this->getHash($operatorData) !== $operatorData['md5sum'];
    }

    private function getHash(array $operatorData): string
    {
        return md5($operatorData['id'] . $operatorData['tr_id '] . $operatorData['tr_amount'] . $operatorData['tr_crc'] . $this->authOperator->getFieldOne());
    }
}
