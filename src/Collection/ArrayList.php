<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use ArrayIterator;
use Iterator;
use Phpsol\Collection\Exception\InvalidType;
use function count;
use function is_a;
use function spl_object_hash;

/**
 * @template   T
 * @implements Collection<T>
 */
final class ArrayList implements Collection
{
    /**
     * @var mixed[]
     * @psalm-var array<T>
     */
    private $elements;

    /** @var Iterator */
    private $iterator;

    /**
     * @var string
     * @psalm-var class-string
     */
    private $allowedClass;

    /**
     * @param mixed[] $elements
     *
     * @psalm-param class-string<T> $allowedClass
     * @psalm-param array<T> $elements
     */
    public function __construct(string $allowedClass, array $elements = [], ?Iterator $iterator = null)
    {
        $this->allowedClass = $allowedClass;
        $this->elements = $elements;
        $this->iterator = $iterator ?? new ArrayIterator();
    }

    /**
     * @inheritDoc
     */
    public function add(object $element) : void
    {
        if (!$this->isAllowed($element)) {
            throw InvalidType::create($this->allowedClass, $element);
        }

        $this->elements[$this->hash($element)] = $element;
    }

    /**
     * @inheritDoc
     */
    public function remove(object $element) : void
    {
        if (!$this->contains($element)) {
            return; // throw expection?
        }

        unset($this->elements[$this->hash($element)]);
    }

    public function getIterator() : Iterator
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

    public function equals(Collection $collection) : bool
    {
        // TODO
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

    private function isAllowed(object $element) : bool
    {
        return is_a($element, $this->allowedClass);
    }

    private function hash(object $element) : string
    {
        return spl_object_hash($element);
    }
}
