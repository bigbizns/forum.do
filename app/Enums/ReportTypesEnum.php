<?php

declare(strict_types=1);

namespace App\Enums;

enum ReportTypesEnum: string
{
    case Fraud = 'Fraud';
    case Scam = 'Scam';
    case Drugs = 'Drugs';
    case Nsfw = 'NSFW';
    case Spam = 'Spam';

    public static function getReportTypes(): array
    {
        $reports = [];

        foreach (self::cases() as $key) {
            $reports[] = [
                'value' => $key->name,
                'name' => $key->value,
            ];
        }

        return $reports;
    }
}

