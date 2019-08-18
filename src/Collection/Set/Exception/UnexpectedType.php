<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set\Exception;

use UnexpectedValueException;
use function get_class;
use function sprintf;

final class UnexpectedType extends UnexpectedValueException
{
    /**
     * @psalm-param class-string $expected
     */
    public static function create(object $object, string $expected) : self
    {
        return new self(sprintf('Object of class "%s" expected. Given: "%s".', $expected, get_class($object)));
    }
}
