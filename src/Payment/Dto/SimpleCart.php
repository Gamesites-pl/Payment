<?php

namespace Gamesites\Payment\Dto;

use RuntimeException;

class SimpleCart extends Item implements DetailInterface
{
    /** @var Item[] */
    private array $items;

    public function addItem(Item $item)
    {
        $this->items[] = $item;
    }

    public function setDiscountCode(DiscountCodeInterface $discountCode) {
        arra([$discountCode, 'setDiscount'], $this->items);
    }

    public function getPrice(): float
    {
        $sum = 0;
        foreach ($this->items as $price) {
            $sum += $price->getPrice();
        }

        return $sum;
    }

    public function getDiscountedPrice(): float
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getDiscountedPrice();
        }

        return $sum - ($sum * $this->getDiscount());
    }

    public function setPrice(float $price): self
    {
        throw new RuntimeException('Can not set price to a SimpleCart object');
    }
}
