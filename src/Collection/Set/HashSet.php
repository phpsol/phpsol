<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set;

use ArrayIterator;
use Phpsol\Collection\Set\Exception\DuplicateElement;
use Traversable;
use function count;
use function spl_object_hash;

/**
 * @template TKey as string
 * @template TValue of object
 * @template-implements Set<TKey, TValue>
 */
final class HashSet implements Set
{
    /** @var array<TKey, TValue> */
    private $elements = [];

    /** @var Traversable<TKey, TValue> */
    private $iterator;

    /**
     * @param array<string|int, TValue> $elements
     *
     * @throws DuplicateElement
     */
    public function __construct(array $elements = [], ?Traversable $iterator = null)
    {
        /** @var Traversable<TKey, TValue> */
        $this->iterator = $iterator ?? new ArrayIterator();

        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    public function add(object $element) : void
    {
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
        return $this->iterator;
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

        foreach ($set as $element) {
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
     * @inheritDoc
     */
    public function toArray() : array
    {
        return $this->elements;
    }

    /**
     * @return TKey as string
     */
    private function hash(object $element) : string
    {
        /** @var TKey as string */
        return spl_object_hash($element);
    }
}
