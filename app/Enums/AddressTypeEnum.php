<?php

namespace App\Enums;

use App\Enums\Traits\EnumToArray;

enum AddressTypeEnum: int
{
    use EnumToArray;

    case Billing        = 1;
    case Residential    = 2;
    case Correspondence = 3;

    public static function getDescription(int $value): string
    {
        return match ($value) {
            self::Billing->value        => 'Cobrança',
            self::Residential->value    => 'Residencial',
            self::Correspondence->value => 'Correspondência',
            default                     => 'Desconhecido',
        };
    }
}
