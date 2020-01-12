<?php

declare(strict_types=1);

namespace Phpsol\Collection\Sequence\Exception;

use UnexpectedValueException;

class ElementNotFound extends UnexpectedValueException
{
    public static function create() : self
    {
        return new self('Element not found.');
    }
}
