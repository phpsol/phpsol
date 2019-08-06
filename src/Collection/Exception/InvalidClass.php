<?php

declare(strict_types=1);

namespace Phpsol\Collection\Exception;

use InvalidArgumentException;
use function sprintf;

final class InvalidClass extends InvalidArgumentException
{
    public static function notExists(string $class) : self
    {
        return new self(sprintf('Class "%s" does not exist.', $class));
    }
}
