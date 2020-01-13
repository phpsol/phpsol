<?php

declare(strict_types=1);

namespace Phpsol\Collection\Sequence\Exception;

use UnexpectedValueException;
use function sprintf;

/**
 * @psalm-external-mutation-free
 */
final class IndexOutOfBounds extends UnexpectedValueException
{
    /**
     * @psalm-pure
     */
    public static function create(int $index, int $maximum, int $minimum = 0) : self
    {
        return new self(sprintf('Index %d must be in range of %d...%d (inclusive).', $index, $minimum, $maximum));
    }
}
