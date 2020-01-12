<?php

declare(strict_types=1);

namespace Phpsol\Exception;

use InvalidArgumentException;
use function sprintf;

/**
 * @psalm-external-mutation-free
 */
final class NonExistentClass extends InvalidArgumentException
{
    /**
     * @psalm-param class-string $class
     *
     * @psalm-pure
     */
    public static function create(string $class) : self
    {
        return new self(sprintf('Class "%s" does not exist.', $class));
    }
}