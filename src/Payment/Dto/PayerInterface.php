<?php

namespace Gamesites\Payment\Dto;

interface PayerInterface
{
    public function getEmail(): ?string;
}