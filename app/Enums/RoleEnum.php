<?php

namespace App\Enums;

use App\Enums\Traits\EnumToArray;

enum RoleEnum: int
{
    use EnumToArray;

    case Secretary = 1;
    case Assistant = 2;
    case Register  = 3;

    public static function getDescription(int $value): string
    {
        return match ($value) {
            self::Secretary->value => 'Secretaria',
            self::Assistant->value => 'Assistente',
            self::Register->value  => 'Cadastro',
            default                => 'Desconhecido',
        };
    }
}
