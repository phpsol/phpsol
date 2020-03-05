<?php

declare(strict_types=1);

namespace Phpsol\Collection\Exception;

use InvalidArgumentException;

/**
 * @psalm-external-mutation-free
 */
final class DuplicateElement extends InvalidArgumentException
{
    /**
     * @psalm-pure
     */
    public static function create() : self
    {
        return new self('Element already exists in the set.');
    }
}
