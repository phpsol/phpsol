<?php

declare(strict_types=1);

namespace Phpsol\Generic;

use Phpsol\Type\MixedType;
use Phpsol\Type\Type;

final class Template
{
    private Type $asType;
    private ?Type $initialType;

    private function __construct(Type $type)
    {
        $this->asType = $type;
    }

    public static function mixed() : self
    {
        return new self(new MixedType());
    }

    public static function as(Type $type) : self
    {
        return new self($type);
    }

    /**
     * @param mixed $value
     */
    public function initialize($value) : void
    {
        $intialType = TypeResolver::resolve($value);

        if (!$initialType->isOf($this->asType)) {
            // throw exception
        }

        $this->initialType = $initialType;
    }

    /**
     * @param mixed $value
     */
    public function match($value) : bool
    {
        $valueType = TypeResolver::resolve($value);

        return $valueType->isOf($this->initialType);
    }

    /**
     * @param iterable<mixed> $values
     */
    public function matchAll(iterable $values) : bool
    {
        foreach ($values as $value) {
            if (!$this->match($value)) {
                return false;
            }
        }

        return true;
    }
}
