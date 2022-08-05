<?php

namespace Gamesites\Payment\Dto;

interface PriceInterface
{
    public function getPrice(): float;

    public function getDiscount(): float;

    public function getDiscountedPrice(): float;
}
