<?php

namespace App\Core\Enums;

enum PriorityEnum: string
{
    case Low = 'low';

    case Medium = 'medium';

    case High = 'high';

    case Critical = 'critical';
}
