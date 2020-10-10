<?php

declare(strict_types=1);

namespace Phpsol\Generic\Type;

use Phpsol\Generic\Type;

final class TArray implements Type
{
    public function toString() : string
    {
        return 'array';
    }

    public function isAssignable(Type $type) : bool
    {
        return $type instanceof self || (new TMixed())->isAssignable($type);
    }
}
