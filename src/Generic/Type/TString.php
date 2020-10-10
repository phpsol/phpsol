<?php

declare(strict_types=1);

namespace Phpsol\Generic\Type;

use Phpsol\Generic\Type;

final class TString implements Type
{
    public function toString() : string
    {
        return 'string';
    }

    public function isAssignable(Type $type) : bool
    {
        return $type instanceof self || (new TScalar())->isAssignable($type);
    }
}
