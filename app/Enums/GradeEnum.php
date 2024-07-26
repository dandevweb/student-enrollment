<?php

namespace App\Enums;

enum GradeEnum: int
{
    case G1           = 1;
    case G2           = 2;
    case G3           = 3;
    case First        = 4;
    case Second       = 5;
    case Third        = 6;
    case Fourth       = 7;
    case Fifth        = 8;
    case Sixth        = 9;
    case Seventh      = 10;
    case Eighth       = 11;
    case Ninth        = 12;
    case FirstYearHS  = 13;
    case SecondYearHS = 14;
    case ThirdYearHS  = 15;

    public static function getDescription(int $value): string
    {
        return match ($value) {
            self::G1->value           => 'G1',
            self::G2->value           => 'G2',
            self::G3->value           => 'G3',
            self::First->value        => '1º ano',
            self::Second->value       => '2º ano',
            self::Third->value        => '3º ano',
            self::Fourth->value       => '4º ano',
            self::Fifth->value        => '5º ano',
            self::Sixth->value        => '6º ano',
            self::Seventh->value      => '7º ano',
            self::Eighth->value       => '8º ano',
            self::Ninth->value        => '9º ano',
            self::FirstYearHS->value  => '1º ano do Ensino Médio',
            self::SecondYearHS->value => '2º ano do Ensino Médio',
            self::ThirdYearHS->value  => '3º ano do Ensino Médio',
            default                   => 'Desconhecido',
        };
    }
}
