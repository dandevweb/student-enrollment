<?php

namespace App\Enums;

use App\Enums\Traits\EnumToArray;

enum GradeEnum: int
{
    use EnumToArray;

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

    public static function getDescription(self $value): string
    {
        return match ($value) {
            self::G1          => 'G1',
            self::G2          => 'G2',
            self::G3          => 'G3',
            self::First       => '1º ano',
            self::Second      => '2º ano',
            self::Third       => '3º ano',
            self::Fourth      => '4º ano',
            self::Fifth       => '5º ano',
            self::Sixth       => '6º ano',
            self::Seventh     => '7º ano',
            self::Eighth      => '8º ano',
            self::Ninth       => '9º ano',
            self::FirstYearHS => '1º ano do Ensino Médio',
            self::SecondYearHS=> '2º ano do Ensino Médio',
            self::ThirdYearHS => '3º ano do Ensino Médio',
            default                   => 'Desconhecido',
        };
    }
}
