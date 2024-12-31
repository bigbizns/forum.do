<?php

declare(strict_types=1);

namespace App\Enums;


enum ReportTypeEnum: string
{
    case Post = 'Post';

    case Comment = 'Comment';
    case Profile = 'Profile';
}
