<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use ArrayIterator;
use Iterator;
use Phpsol\Collection\Exception\DuplicateElement;
use Phpsol\Collection\Exception\InvalidClass;
use Phpsol\Collection\Exception\UnexpectedType;
use function array_values;
use function class_exists;
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
    private $class;

    /**
     * @param string $class The class which all elements must implement.
     * @param mixed[] $elements
     *
     * @throws InvalidClass
     * @throws DuplicateElement
     * @throws UnexpectedType
     *
     * @psalm-param class-string<T> $allowedClass
     * @psalm-param array<T> $elements
     */
    public function __construct(string $class, array $elements = [], ?Iterator $iterator = null)
    {
        if (!class_exists($class)) {
            throw InvalidClass::notExists($class);
        }

        $this->class = $class;
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

        if (!$this->isAllowed($element)) {
            throw UnexpectedType::create($this->class, $element);
        }

        $this->elements[$this->hash($element)] = $element;
    }

    public function remove(object $element) : void
    {
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
        if ($collection->count() !== $this->count()) {
            return false;
        }

        foreach ($collection as $hash => $element) {
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
        return array_values($this->elements);
    }

    private function isAllowed(object $element) : bool
    {
        return is_a($element, $this->class);
    }

    private function hash(object $element) : string
    {
        return spl_object_hash($element);
    }
}
