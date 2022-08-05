<?php

namespace Gamesites\Payment\Enum;

enum OperatorEnum: string
{
    case CASH_BILL = 'CashBill';
    case DIRECT_BILLING = 'DirectBilling';
    case HOT_PAY = 'HotPay';
    case MICRO_SMS = 'MicroSMS';
    case PAY_SAFE_CARD_PAY_BTY_LINK = 'PaySafeCardPyByLink';
    case PAY_SAFE_CARD_HOT_PAY = 'PaySafeCardHotPay';
    case T_PAY = 'TPay';
}
