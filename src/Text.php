<?php

declare(strict_types=1);

namespace Phpsol;

final class Text
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

    public function equals(self $other) : bool
    {
        return $this->value() === $other->value();
    }

    /**
     * @return array<string>
     */
    public function explode(string $delimiter) : array
    {
        $exploded = \explode($delimiter, $this->value());

        return $exploded === false ? [] : $exploded;
    }

    public function __toString() : string
    {
        return $this->value();
    }
}
