<?php

declare(strict_types=1);

namespace Phpsol\Generic\Exception;

use UnexpectedValueException;
use function sprintf;

final class UndefinedTemplate extends UnexpectedValueException
{
    public static function withName(string $name) : self
    {
        return new self(sprintf('Template with name "%s" is not defined.', $name));
    }
}
