<?php

declare(strict_types=1);

namespace Phpsol\Generic\Exception;

use InvalidArgumentException;

use function sprintf;

final class UndefinedTemplate extends InvalidArgumentException
{
    public static function withName(string $name) : self
    {
        return new self(sprintf('Template with name "%s" is not defined.', $name));
    }
}
