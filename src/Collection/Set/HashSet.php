<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set;

use ArrayIterator;
use Phpsol\Collection\Set\Exception\DuplicateElement;
use Phpsol\Collection\Set\Exception\NonExistentClass;
use Phpsol\Collection\Set\Exception\UnexpectedType;
use Traversable;
use function array_values;
use function class_exists;
use function count;
use function is_a;
use function spl_object_hash;

/**
 * @template TValue of object
 *
 * @template-implements Set<string, TValue>
 */
final class HashSet implements Set
{
    /** @var class-string */
    private $class;

    /** @var array<string, TValue> */
    private $elements = [];

    /**
     * @param class-string<TValue> $class
     * @param array<string|int, TValue> $elements
     *
     * @throws NonExistentClass
     * @throws UnexpectedType
     * @throws DuplicateElement
     */
    public function __construct(string $class, array $elements = [])
    {
        if (!class_exists($class)) {
            throw NonExistentClass::create($class);
        }

        $this->class = $class;

        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    /**
     * @throws UnexpectedType
     * @throws DuplicateElement
     */
    public function add(object $element) : void
    {
        if (!is_a($element, $this->class)) {
            throw UnexpectedType::create($element, $this->class);
        }

        if ($this->contains($element)) {
            throw DuplicateElement::create();
        }

        $this->elements[$this->hash($element)] = $element;
    }

    public function remove(object $element) : void
    {
        unset($this->elements[$this->hash($element)]);
    }

    public function getIterator() : Traversable
    {
        return new ArrayIterator($this->elements);
    }

    public function count() : int
    {
        return count($this->elements);
    }

    public function clear() : void
    {
        $this->elements = [];
    }

    public function contains(object $element) : bool
    {
        return isset($this->elements[$this->hash($element)]);
    }

    public function equals(Set $set) : bool
    {
        if ($set->count() !== $this->count()) {
            return false;
        }

        foreach ($set as $index => $element) {
            if (!$this->contains($element)) {
                return false;
            }
        }

        return true;
    }

    public function isEmpty() : bool
    {
        return $this->count() === 0;
    }

    /**
     * @return array<int, TValue>
     */
    public function toArray() : array
    {
        return array_values($this->elements);
    }

    private function hash(object $element) : string
    {
        return spl_object_hash($element);
    }
}