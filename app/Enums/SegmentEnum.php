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


    public static function getDescription(self $value): string
    {
        return match ($value) {
            self::Childish    => 'Infantil',
            self::EarlyYears  => 'Anos iniciais',
            self::MiddleYears => 'Anos finais',
            self::HighSchool  => 'Ensino Médio',
            default                  => 'Desconhecido',
        };
    }
}
