<?php

declare(strict_types=1);

namespace Phpsol\Configuration;

final class Phpsol
{
    private static RuntimeAssertions $assertions;

    public static function runtimeAssertions() : RuntimeAssertions
    {
        if (self::$assertions === null) {
            self::$assertions = new RuntimeAssertions(true);
        }

        return self::$assertions;
    }
}
