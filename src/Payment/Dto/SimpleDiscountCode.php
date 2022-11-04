<?php

namespace Gamesites\Payment\Dto;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class SimpleDiscountCode implements DiscountCodeInterface
{
    private string $expression;

    /** @var Item[] */
    private array $supportedItems;

    public function __construct(string $expression, array $supportedItems)
    {
        $this->expression = $expression;
        $this->supportedItems = $supportedItems;
    }

    public function setDiscount(Item $item): Item
    {
        $ex = new ExpressionLanguage();

        if (in_array($item->getId(), array_map(fn(Item $item) => $item->getId(), $this->supportedItems))) {
            $item->setDiscount($ex->evaluate($this->expression));
        }

        return $item;
    }
}
