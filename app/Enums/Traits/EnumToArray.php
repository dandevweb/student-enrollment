<?php

namespace App\Enums\Traits;

trait EnumToArray
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function arrayToSelect(): array
    {
        return array_map(
            fn ($case) => ['name' => self::getDescription($case->value), 'value' => $case->value],
            self::cases()
        );
    }

}
