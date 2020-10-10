<?php

declare(strict_types=1);

namespace Phpsol\Generic\Type;

use Phpsol\Generic\Type;

final class TScalar implements Type
{
    public function toString() : string
    {
        return 'scalar';
    }

    public function isAssignable(Type $type) : bool
    {
        return $type instanceof self || (new TMixed())->isAssignable($type);
    }
}