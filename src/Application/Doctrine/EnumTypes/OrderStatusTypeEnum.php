<?php

namespace App\Application\Doctrine\EnumTypes;

enum OrderStatusTypeEnum: string
{
    case Created      = 'Created';
    case InProgress   = 'InProgress';
    case Done         = 'Done';
}
