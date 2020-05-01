<?php

declare(strict_types=1);

namespace Phpsol\Configuration;

final class Phpsol
{
    /** @var Assertions */
    private static $assertions;

    public static function assertions() : Assertions
    {
        if (self::$assertions === null) {
            self::$assertions = new Assertions(true);
        }

        return self::$assertions;
    }
}
