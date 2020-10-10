<?php

declare(strict_types=1);

namespace Phpsol\Generic;

use Phpsol\Generic\Exception\MismatchedTemplate;
use Phpsol\Generic\Type\Factory;
use Phpsol\Generic\Type\TMixed;

/**
 * @psalm-external-mutation-free
 */
final class Template
{
    private Type $superType;
    private ?Type $type = null;

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
        $type = Factory::fromValue($value);

        if (!$type->isAssignable($this->superType)) {
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

        $valueType = Factory::fromValue($value);

        return $valueType->isAssignable($this->type);
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
