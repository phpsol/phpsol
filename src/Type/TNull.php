<?php

declare(strict_types=1);

namespace Phpsol\Type;

final class TNull implements Type
{
    public function toString() : string
    {
        return 'null';
    }

    public function parent() : ?TClassString
    {
        return null;
    }
}
