<?php

declare(strict_types=1);

namespace Phpsol;

final class StringObject
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value() : string
    {
        return $this->value;
    }

    public function __toString() : string
    {
        return $this->value();
    }
}
