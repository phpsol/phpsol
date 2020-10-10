<?php

declare(strict_types=1);

namespace Phpsol\Generic\Type;

use Phpsol\Generic\Type;

final class TMixed implements Type
{
    public function toString() : string
    {
        return 'mixed';
    }

    public function isAssignable(Type $type) : bool
    {
        return $type instanceof self;
    }
}
