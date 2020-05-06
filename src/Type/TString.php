<?php

declare(strict_types=1);

namespace Phpsol\Type;

final class TString implements Type
{
    public function toString() : string
    {
        return 'string';
    }

    public function parent() : ?Type
    {
        return new TMixed();
    }
}
