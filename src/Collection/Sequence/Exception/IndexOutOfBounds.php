<?php

declare(strict_types=1);

namespace Phpsol\Collection\Sequence\Exception;

use UnexpectedValueException;
use function sprintf;

class IndexOutOfBounds extends UnexpectedValueException
{
    public static function create(int $index, int $maximum, int $minimum = 0) : self
    {
        return new self(sprintf('Index %d must be in range of %d...%d (inclusive).', $index, $minimum, $maximum));
    }
}
