<?php

declare(strict_types=1);

namespace Phpsol\Generic;

use Phpsol\Generic\Exception\MismatchedTemplate;
use Phpsol\Type\TMixed;
use Phpsol\Type\Type;
use Phpsol\Type\TypeResolver;

final class Template
{
    private Type $superType;
    private ?Type $type;

    private function __construct(Type $type)
    {
        $this->superType = $type;
    }

    public static function mixed() : self
    {
        return new self(new TMixed());
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
        $type = TypeResolver::resolve($value);

        if (!TypeResolver::isOf($type, $this->superType)) {
            throw MismatchedTemplate::mismatchedType($this->superType, $type);
        }

        $this->type = $type;
    }

    /**
     * @param mixed $value
     */
    public function match($value) : bool
    {
        if ($this->type === null) {
            $this->initialize($value);
        }

        $valueType = TypeResolver::resolve($value);

        return TypeResolver::isOf($valueType, $this->type);
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
