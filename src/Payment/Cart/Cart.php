<?php

namespace Gamesites\Payment\Cart;

use Gamesites\Payment\Dto\PriceInterface;

class Cart implements PriceInterface
{
    /** @var PriceInterface[] */
    private array $prices;

    /** @var callable */
    private $callback;
    private float $discount = .0;

    public function addPrice(PriceInterface $price)
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

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount)
    {
        $this->discount = $discount;
    }

    public function getDiscountedPrice(): float
    {
        $sum = 0;
        foreach ($this->prices as $price) {
            $sum += ($this->callback)();
        }

        return $sum;
    }

    public function setDiscountFunction(callable $callback): float
    {
        $this->callback = $callback;
    }
}
