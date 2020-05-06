<?php

declare(strict_types=1);

namespace Phpsol\Type;

final class TInteger implements Type
{
    public function toString() : string
    {
        return 'int';
    }

    public function parent() : ?Type
    {
        return new TMixed();
    }
}
