<?php

declare(strict_types=1);

namespace Phpsol\Collection\Sequence;

use ArrayIterator;
use Phpsol\Collection\Collection;
use Phpsol\Collection\Exception\ElementNotFound;
use Phpsol\Collection\Sequence\Exception\IndexOutOfBounds;
use Traversable;
use function array_splice;
use function array_values;
use function count;
use function is_int;

/**
 * @template E
 *
 * @template-implements Sequence<E>
 *
 * @psalm-external-mutation-free
 */
class ArraySequence implements Sequence
{
    /**
     * @psalm-var array<int, E>
     * @var array<int, mixed>
     */
    private $elements;

    /**
     * @psalm-param array<array-key, E> $elements
     * @param array<int|string, mixed> $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = array_values($elements);
    }

    /**
     * @inheritDoc
     */
    public function add($element) : void
    {
        $this->elements[] = $element;
    }

    /**
     * @inheritDoc
     */
    public function addAt(int $index, $element) : void
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
    public function get(int $index)
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
    public function remove($element) : void
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
    public function indexOf($element) : int
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
     * @param mixed $element
     *
     * @psalm-pure
     */
    public function contains($element) : bool
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
     * @psalm-return array<int, E>
     *
     * @return array<int, mixed>
     *
     * @psalm-pure
     */
    public function toArray() : array
    {
        return array_values($this->elements);
    }
}
