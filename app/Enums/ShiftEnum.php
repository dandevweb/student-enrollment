<?php

namespace App\Enums\Enums;

enum ShiftEnum: int
{
    case Morning   = 1;
    case Afternoon = 2;
    case FullTime  = 3;

    public static function getDescription(int $value): string
    {
        return match ($value) {
            self::Morning->value   => 'Manhã',
            self::Afternoon->value => 'Tarde',
            self::FullTime->value  => 'Integral',
            default                => 'Desconhecido',
        };
    }
}
