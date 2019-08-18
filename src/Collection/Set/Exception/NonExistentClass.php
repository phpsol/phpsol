<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set\Exception;

use InvalidArgumentException;
use function sprintf;

final class NonExistentClass extends InvalidArgumentException
{
    /**
     * @psalm-param class-string $class
     */
    public static function create(string $class) : self
    {
        return new self(sprintf('Class "%s" does not exist.', $class));
    }
}
