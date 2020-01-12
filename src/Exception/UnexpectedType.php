<?php

declare(strict_types=1);

namespace Phpsol\Exception;

use UnexpectedValueException;
use function class_exists;
use function get_class;
use function gettype;
use function interface_exists;
use function sprintf;

final class UnexpectedType extends UnexpectedValueException
{
    /** @param mixed $value */
    public static function of($value, string $expected) : self
    {
        $type = gettype($value);

        if ($type === 'object' && (class_exists($expected) || interface_exists($expected))) {
            /** @var object $value */
            return self::ofObject($value, $expected);
        }

        return new self(sprintf('Type "%s" expected. Given "%s".', $expected, $type));
    }

    /** @psalm-param class-string $expected */
    public static function ofObject(object $object, string $expected) : self
    {
        return new self(sprintf('Object of class "%s" expected. Given: "%s".', $expected, get_class($object)));
    }
}
