<?php

namespace App\Enums\Enums;

enum AddressTypeEnum: int
{
    case Billing = 1;
    case Residential = 2;
    case Correspondence = 3;

    public static function getDescription(int $value): string
    {
        return match ($value) {
            self::Billing => 'Cobrança',
            self::Residential => 'Residencial',
            self::Correspondence => 'Correspondência',
        };
    }
}