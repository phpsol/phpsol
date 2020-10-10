<?php

declare(strict_types=1);

namespace Phpsol\Generic\Type;

use Phpsol\Generic\Type;

final class TBoolean implements Type
{
    public function toString() : string
    {
        return 'bool';
    }

    public function isAssignable(Type $type) : bool
    {
        return $type instanceof self || (new TScalar())->isAssignable($type);
    }
}
