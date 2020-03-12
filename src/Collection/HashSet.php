<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use ArrayIterator;
use Phpsol\Collection\Exception\DuplicateElement;
use Phpsol\Collection\Exception\ElementNotFound;
use Traversable;
use function array_values;
use function count;
use function spl_object_hash;

/**
 * @template E as object
 *
 * @template-implements Set<E>
 *
 * @psalm-external-mutation-free
 */
final class HashSet implements Set
{
    /**
     * @psalm-var array<string, E>
     * @var array<string, mixed>
     */
    private $elements = [];

    /**
     * @psalm-param class-string<E> $class
     * @psalm-param array<array-key, E> $elements
     * @param array<mixed> $elements
     *
     * @throws DuplicateElement
     */
    public function __construct(array $elements = [])
    {
        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    /**
     * @inheritDoc
     */
    public function add($element) : void
    {
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
        if (!$this->contains($element)) {
            throw ElementNotFound::create();
        }

        unset($this->elements[$this->hash($element)]);
    }

    /**
     * @inheritDoc
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
     * @inheritDoc
     *
     * @psalm-param E $element
     */
    public function contains($element) : bool
    {
        return isset($this->elements[$this->hash($element)]);
    }

    /**
     * @inheritDoc
     *
     * @psalm-param Collection<E> $collection
     */
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
