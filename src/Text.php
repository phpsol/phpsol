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
        $contains = \strpos($this->value(), $text->value());

        return \is_int($contains);
    }

    public function length() : int
    {
        return \strlen($this->value());
    }

    public function replace(Text $target, Text $replacement) : self
    {
        return new Text(\str_replace($target->value(), $replacement->value(), $this->value()));
    }

    /**
     * @return array<self>
     */
    public function split(string $delimiter) : array
    {
        $parts = \explode($delimiter, $this->value());

        if ($parts === false) {
            return [clone $this];
        }

        return \array_map(
            static function ($part) {
                return new Text($part);
            },
            $parts
        );
    }

    public function __toString() : string
    {
        return $this->value();
    }
}
