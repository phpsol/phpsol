<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set\Exception;

use InvalidArgumentException;

final class DuplicateElement extends InvalidArgumentException
{
    public static function create() : self
    {
        return new self('Element already exists in the set.');
    }
}
