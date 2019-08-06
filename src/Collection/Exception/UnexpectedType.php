<?php

declare(strict_types=1);

namespace Phpsol\Collection\Exception;

use UnexpectedValueException;
use function get_class;
use function sprintf;

final class UnexpectedType extends UnexpectedValueException
{
    /**
     * @psalm-param class-string $expected
     */
    public static function create(string $expected, object $actual) : self
    {
        return new self(
            sprintf(
                'Expected: %s. Actual: %s.',
                $expected,
                get_class($actual)
            )
        );
    }
}
