<?php

declare(strict_types=1);

namespace Phpsol\Type;

final class TMixed implements Type
{
    public function toString() : string
    {
        return 'mixed';
    }

    public function parent() : ?Type
    {
        return null;
    }
}
