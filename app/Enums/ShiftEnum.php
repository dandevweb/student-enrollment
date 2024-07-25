<?php

namespace App\Enums\Enums;

enum ShiftEnum: int
{
    case Morning = 1;
    case Afternoon = 2;
    case FullTime = 3;

    public static function getDescription(int $value): string
    {
        return match ($value) {
            self::Morning => 'Manhã',
            self::Afternoon => 'Tarde',
            self::FullTime => 'Integral',
        };
    }
}