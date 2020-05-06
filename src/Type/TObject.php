<?php

declare(strict_types=1);

namespace Phpsol\Type;

final class TObject implements Type
{
    public function toString() : string
    {
        return 'object';
    }

    public function parent() : ?Type
    {
        return new TMixed();
    }
}
