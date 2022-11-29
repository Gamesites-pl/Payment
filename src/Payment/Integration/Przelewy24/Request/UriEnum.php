<?php

namespace Gamesites\Payment\Integration\Przelewy24\Request;

enum UriEnum: string
{
    case TOKEN_REDIRECT = 'trnRequest/';
    case API_TRANSACTION_REGISTER = 'api/v1/transaction/register';
    case API_TRANSACTION_VERIFY = 'api/v1/transaction/verify';
}
