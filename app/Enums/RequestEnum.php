<?php

declare(strict_types=1);

namespace App\Enums;

enum RequestEnum: string
{
    case Edit = 'Edit';
    case Delete = 'Delete';
}
