<?php

namespace Gamesites\Payment\Dto;

use Gamesites\Payment\Enum\PaymentStatusEnum;

interface HistoryInterface
{
    public function getLastStoredStatus(): PaymentStatusEnum;
    public function getId(): int;
}
