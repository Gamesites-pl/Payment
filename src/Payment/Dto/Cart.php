<?php

namespace Gamesites\Payment\Dto;

class Cart extends Price implements DetailInterface
{
    /** @var Price[] */
    private array $prices;

    public function addPrice(Price $price)
    {
        $this->prices[] = $price;
    }

    public function getPrice(): float
    {
        $sum = 0;
        foreach ($this->prices as $price) {
            $sum += $price->getPrice();
        }

        return $sum;
    }

    public function getDiscountedPrice(): float
    {
        $sum = 0;
        foreach ($this->prices as $price) {
            $sum += $price->getDiscountedPrice();
        }

        return $sum - ($sum * $this->getDiscount());
    }

    public function setPrice(float $price): self
    {
        throw new \RuntimeException('Can not set price to a Cart object');
    }
}
