<?php

declare(strict_types=1);

namespace Phpsol\Generic\Exception;

use LogicException;
use Phpsol\Generic\Type;

use function sprintf;

final class TemplateAlreadyInitialized extends LogicException
{
    public static function withType(Type $type) : self
    {
        return new self(sprintf('Template is already initialized with type "%s".', $type->toString()));
    }
}
