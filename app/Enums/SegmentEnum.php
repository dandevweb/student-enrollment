<?php

namespace App\Enums;

use App\Enums\Traits\EnumToArray;

enum SegmentEnum: int
{
    use EnumToArray;

    case Childish    = 1;
    case EarlyYears  = 2;
    case MiddleYears = 3;
    case HighSchool  = 4;


    public static function getDescription(int $value): string
    {
        return match ($value) {
            self::Childish->value    => 'Infantil',
            self::EarlyYears->value  => 'Anos iniciais',
            self::MiddleYears->value => 'Anos finais',
            self::HighSchool->value  => 'Ensino Médio',
            default                  => 'Desconhecido',
        };
    }
}
