<?php

declare(strict_types=1);

namespace Phpsol;

use function is_int;
use function strpos;

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

    public function equals(self $text) : bool
    {
        return $this->value() === $text->value();
    }

    public function concatenate(self $text) : self
    {
        return new Text($this->value() . $text->value());
    }

    public function contains(self $text) : bool
    {
        $contains = strpos($this->value(), $text->value());

        return is_int($contains);
    }

    /**
     * @return array<self>
     */
    public function explode(string $delimiter) : array
    {
        $parts = \explode($delimiter, $this->value());

        if ($parts === false) {
            return [$this->value()];
        }

        foreach ($parts as $index => $part) {
            $parts[$index] = new Text($part);
        }

        return $parts;
    }

    public function __toString() : string
    {
        return $this->value();
    }
}
