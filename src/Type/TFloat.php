<?php

declare(strict_types=1);

namespace Phpsol\Type;

final class TFloat implements Type
{
    public function toString() : string
    {
        return 'float';
    }

    public function parent() : ?Type
    {
        return new TMixed();
    }
}
