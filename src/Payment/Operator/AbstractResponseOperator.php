<?php

namespace Gamesites\Payment\Operator;

use RuntimeException;
use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Enum\PaymentStatusEnum;
use Gamesites\Payment\Integration\HotPay\AuthOperator;

abstract class AbstractResponseOperator implements ResponseOperatorInterface
{
    protected array $successfullyStatuses;
    protected string $statusField;

    protected AuthOperator $authOperator;

    public function __construct(AuthOperator $authOperator)
    {
        $this->authOperator = $authOperator;
    }

    public function getResponse(array $operatorData, HistoryInterface $history): PaymentStatusEnum
    {
        return match (false) {
            $this->handlePaymentExist($operatorData, $history) => PaymentStatusEnum::NOT_EXISTED,
            $this->handleUnsuccessfullyResponse($operatorData[$this->statusField], $history) => PaymentStatusEnum::UNACCEPTED,
            default => PaymentStatusEnum::REALIZED,
        };
    }

    /** @throws RuntimeException */
    private function handleUnsuccessfullyResponse(?string $status, HistoryInterface $history): bool
    {
        return in_array($status, $this->successfullyStatuses);
    }
}
