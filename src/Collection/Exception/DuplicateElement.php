<?php

declare(strict_types=1);

namespace Phpsol\Collection\Exception;

use UnexpectedValueException;

final class DuplicateElement extends UnexpectedValueException
{
    public static function create() : self
    {
        return new self('Element already exists in the collection.');
    }
}
