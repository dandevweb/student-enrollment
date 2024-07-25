<?php

namespace App\Enums;

enum SegmentEnum: int
{
    case Childish = 1;
    case EarlyYears = 2;
    case MiddleYears = 3;
    case HighSchool = 4;


    public static function getDescription(int $value): string
    {
        return match ($value) {
            self::Childish => 'Infantil',
            self::EarlyYears => 'Anos iniciais',
            self::MiddleYears => 'Anos finais',
            self::HighSchool => 'Ensino Médio',
        };
    }
}