<?php

declare(strict_types=1);

namespace App\Enums;

enum TradeActionEnum: string
{
    case Buying = 'Buying';
    case Selling = 'Selling';

    public static function getTradeActions(): array
    {
        $tradeAction = [];

        foreach (self::cases() as $key) {
            $tradeAction[] = [
                'value' => $key->name,
                'name' => $key->value,
            ];
        }
        return $tradeAction;
    }
}
