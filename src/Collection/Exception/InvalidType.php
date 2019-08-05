<?php

declare(strict_types=1);

namespace Phpsol\Collection\Exception;

use InvalidArgumentException;
use function get_class;
use function sprintf;

final class InvalidType extends InvalidArgumentException
{
    /**
     * @psalm-param class-string $expected
     */
    public static function create(string $expected, object $actual) : self
    {
        return new self(
            sprintf(
                'Invalid type. Expected: %s. Actual: %s.',
                $expected,
                get_class($actual)
            )
        );
    }
}
