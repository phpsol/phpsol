<?php

declare(strict_types=1);

namespace Phpsol\Type;

final class TBoolean implements Type
{
    public function toString() : string
    {
        return 'bool';
    }

    public function parent() : ?Type
    {
        return new TMixed();
    }
}
