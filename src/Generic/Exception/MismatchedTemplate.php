<?php

declare(strict_types=1);

namespace Phpsol\Generic\Exception;

use InvalidArgumentException;
use Phpsol\Generic\Type;

use function sprintf;

final class MismatchedTemplate extends InvalidArgumentException
{
    public static function mismatchedType(Type $expected, Type $actual) : self
    {
        return new self(
            sprintf(
                'Value expected to be of type "%s". Provided: %s.',
                $expected->toString(),
                $actual->toString()
            )
        );
    }
}
