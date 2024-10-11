<?php

declare(strict_types=1);

namespace App\Enums;

enum SupportTopicEnum: string
{
    case Bug = 'Bug';
    case Advertise = 'Advertise';
    case FeatureRequest = 'Feature Request';

    public static function getSupportTopic(): array
    {
        $topics = [];

        foreach (self::cases() as $key) {
            $topics[] = [
                'value' => $key->name,
                'name' => $key->value,
            ];
        }
        return $topics;
    }
}


