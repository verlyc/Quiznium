<?php

namespace App\Traits;

trait EnumToArray
{
    public static function toArray(): array {
        return array_map(
            fn(self $enum) => $enum->name,
            self::cases()
        );
    }

    // get by label => value
    public static function collect(): array {
        return array_map(
            fn(self $enum) => ['label' => $enum->value, 'value' => $enum->name],
            self::cases()
        );
    }
}
