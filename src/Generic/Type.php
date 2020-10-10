<?php

declare(strict_types=1);

namespace Phpsol\Generic;

interface Type
{
    public function toString() : string;

    public function isAssignable(Type $type) : bool;
}
