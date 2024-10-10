<?php

declare(strict_types=1);

namespace App\Enums;

enum CategoryEnum: string
{
    case Discussions = 'Discussions';
    case GamingMarketplace = 'Gaming Marketplace';
    case SocialMarketplace = 'Social Marketplace';

    public static function getCategories(): array
    {
        $categories = [];

        foreach (self::cases() as $key) {
            $categories[] = [
                'value' => $key->name,
                'name' => $key->value,
            ];
        }
        return $categories;
    }
}
