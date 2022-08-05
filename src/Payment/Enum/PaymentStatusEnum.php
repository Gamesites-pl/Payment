<?php

namespace Gamesites\Payment\Enum;

enum PaymentStatusEnum: string
{
    case CREATED = "10";
    case ACCEPTED = "11";

    case REALIZED = "20";

    case UNACCEPTED = "42";
    case TIME_OUT = "43";
    case CANCELED = "44";

    case NOT_EXISTED = "51";
}
