<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use ArrayIterator;
use Phpsol\Collection\Exception\ElementNotFound;
use Phpsol\Collection\Exception\IndexOutOfBounds;
use Traversable;
use function array_splice;
use function array_values;
use function count;
use function is_int;

/**
 * @template E as object
 *
 * @template-implements Sequence<E>
 *
 * @psalm-external-mutation-free
 */
final class ArraySequence implements Sequence
{
    /**
     * @psalm-var list<E>
     * @var array<int, object>
     */
    private $elements;

    /**
     * @psalm-param array<array-key, E> $elements
     * @param array<int|string, object> $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = array_values($elements);
    }

    /**
     * @inheritDoc
     */
    public function add(object $element) : void
    {
        $this->elements[] = $element;
    }

    /**
     * @inheritDoc
     */
    public function addAt(int $index, object $element) : void
    {
        $size = $this->count();
        if ($index < 0 || $index > $size) {
            throw IndexOutOfBounds::create($index, $size);
        }

        array_splice($this->elements, $index, 0, [$element]);
    }

    /**
     * @inheritDoc
     */
    public function get(int $index) : object
    {
        $size = $this->count();
        if ($index < 0 || $index >= $size) {
            throw IndexOutOfBounds::create($index, $size - 1);
        }

        return $this->elements[$index];
    }

    /**
     * @inheritDoc
     */
    public function remove(object $element) : void
    {
        if (!$this->contains($element)) {
            throw ElementNotFound::create();
        }

        $this->removeAt($this->indexOf($element));
    }

    /**
     * @inheritDoc
     */
    public function removeAt(int $index) : void
    {
        $size = $this->count();
        if ($index < 0 || $index >= $size) {
            throw IndexOutOfBounds::create($index, $size - 1);
        }

        array_splice($this->elements, $index, 1);
    }

    /**
     * @inheritDoc
     */
    public function indexOf(object $element) : int
    {
        foreach ($this->elements as $index => $_element) {
            if ($_element === $element) {
                return $index;
            }
        }

        throw ElementNotFound::create();
    }

    /**
     * @psalm-param E $element
     *
     * @psalm-pure
     */
    public function contains(object $element) : bool
    {
        foreach ($this->elements as $_element) {
            if ($_element === $element) {
                return true;
            }
        }

        return false;
    }

    /**
     * @psalm-param Collection<E> $collection
     *
     * @psalm-pure
     */
    public function equals(Collection $collection) : bool
    {
        if ($collection->count() !== $this->count()) {
            return false;
        }

        foreach ($collection->getIterator() as $index => $element) {
            if (!is_int($index)) {
                return false;
            }

            if (!isset($this->elements[$index])) {
                return false;
            }
            if ($this->get($index) !== $element) {
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
     * @psalm-return Traversable<int, E>
     *
     * @psalm-pure
     */
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
     * @psalm-return list<E>
     * @return array<int, object>
     *
     * @psalm-pure
     */
    public function toArray() : array
    {
        return array_values($this->elements);
    }
}
