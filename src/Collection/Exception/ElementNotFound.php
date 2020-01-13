<?php

declare(strict_types=1);

namespace Phpsol\Collection\Exception;

use UnexpectedValueException;

/**
 * @psalm-external-mutation-free
 */
final class ElementNotFound extends UnexpectedValueException
{
    /**
     * @psalm-pure
     */
    public static function create() : self
    {
        return new self('Element not found.');
    }
}
