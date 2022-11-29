<?php

namespace Gamesites\Payment\Operator;

use RuntimeException;
use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Enum\PaymentStatusEnum;
use Gamesites\Payment\Integration\HotPay\AuthOperator;

abstract class AbstractResponseOperator implements ResponseOperatorInterface
{
    protected AuthOperator $authOperator;

    protected array $successfullyStatuses;
    protected string $statusField;

    public const RESPONSE = 'OK';
    protected string $uri;

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
        return $history->getLastStoredStatus() !== $status && in_array($status, $this->successfullyStatuses);
    }

    public function init(string $uri)
    {
        $this->uri = $uri;
    }
}
