<?php

declare(strict_types=1);

namespace Phpsol\Type;

interface Type
{
    public function toString() : string;

    public function parent() : ?Type;
}
