<?php

declare(strict_types=1);

namespace Phpsol\Generic\Exception;

use Phpsol\Type\Type;
use UnexpectedValueException;
use function sprintf;

final class MismatchedTemplate extends UnexpectedValueException
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
