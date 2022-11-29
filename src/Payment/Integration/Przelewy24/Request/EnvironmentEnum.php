<?php

namespace Gamesites\Payment\Integration\Przelewy24\Request;

enum EnvironmentEnum: string
{
    case SANDBOX = 'https://sandbox.przelewy24.pl/';
    case PRODUCTION = 'https://secure.przelewy24.pl/';
}
