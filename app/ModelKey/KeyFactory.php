<?php

declare(strict_types=1);

namespace App\ModelKey;

use Illuminate\Support\Str;

final class KeyFactory
{
    public static function generate(string $prefix, int|null $length = null): string
    {
        if (null === $length) {
            $length = config(
                key: 'key-factory.key.length',
            );
        }

        $string = Str::random(
            length: $length,
        );

        return "{$prefix}{$string}";
    }
}
