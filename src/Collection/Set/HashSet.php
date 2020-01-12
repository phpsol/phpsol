<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set;

use ArrayIterator;
use Phpsol\Collection\Collection;
use Phpsol\Collection\Set\Exception\DuplicateElement;
use Phpsol\Exception\NonExistentClass;
use Phpsol\Exception\UnexpectedType;
use Traversable;
use function array_values;
use function class_exists;
use function count;
use function is_a;
use function is_object;
use function spl_object_hash;

/**
 * @template E of object
 *
 * @template-implements Set<E>
 *
 * @psalm-external-mutation-free
 */
final class HashSet implements Set
{
    /**
     * @psalm-var class-string
     * @var string
     */
    private $class;

    /**
     * @psalm-var array<string, E>
     * @var array<string, object>
     */
    private $elements = [];

    /**
     * @psalm-param class-string<E> $class
     * @psalm-param array<array-key, E> $elements
     * @param array<string|int, object> $elements
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
     * @inheritDoc
     *
     * @throws UnexpectedType
     * @throws DuplicateElement
     */
    public function add($element) : void
    {
        if (!is_object($element)) {
            throw UnexpectedType::of($element, $this->class);
        }

        if (!is_a($element, $this->class)) {
            throw UnexpectedType::ofObject($element, $this->class);
        }

        if ($this->contains($element)) {
            throw DuplicateElement::create();
        }

        $this->elements[$this->hash($element)] = $element;
    }

    /**
     * @inheritDoc
     */
    public function remove($element) : void
    {
        if (!is_object($element)) {
            throw UnexpectedType::of($element, $this->class);
        }

        if (!is_a($element, $this->class)) {
            throw UnexpectedType::ofObject($element, $this->class);
        }

        unset($this->elements[$this->hash($element)]);
    }

    public function getIterator() : Traversable
    {
        return new ArrayIterator($this->toArray());
    }

    public function count() : int
    {
        return count($this->elements);
    }

    public function clear() : void
    {
        $this->elements = [];
    }

    /**
     * @inheritDoc
     */
    public function contains($element) : bool
    {
        if (!is_object($element)) {
            throw UnexpectedType::of($element, $this->class);
        }

        if (!is_a($element, $this->class)) {
            throw UnexpectedType::ofObject($element, $this->class);
        }

        return isset($this->elements[$this->hash($element)]);
    }

    public function equals(Collection $collection) : bool
    {
        if ($collection->count() !== $this->count()) {
            return false;
        }

        foreach ($collection as $element) {
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

    private function hash(object $element) : string
    {
        return spl_object_hash($element);
    }
}
