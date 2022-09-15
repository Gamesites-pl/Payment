<?php

namespace Gamesites\Payment\Enum;

enum PaymentStatusEnum: string
{
    case CREATED = "10";

    case REALIZED = "20";
    case ACCEPTED = "21";

    case UNACCEPTED = "41";
    case TIME_OUT = "42";
    case CANCELED = "43";

    case NOT_EXISTED = "51";
}
