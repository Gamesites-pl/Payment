<?php

namespace Gamesites\Payment\Dto;

interface DetailInterface
{
    public function getName(): string;
    public function getId(): string;
    public function getDiscountedPrice(): float;
    public function setPrice(float $price): self;
    public function getPrice(): float;
}
