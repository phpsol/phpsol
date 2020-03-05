<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Countable;
use IteratorAggregate;
use Traversable;

/**
 * A collection of elements of the same type.
 *
 * @template E as object
 *
 * @template-extends IteratorAggregate<array-key, E>
 *
 * @psalm-external-mutation-free
 */
interface Collection extends Countable, IteratorAggregate
{
    /**
     * @psalm-param E $element
     *
     * @psalm-pure
     */
    public function contains(object $element) : bool;

    /**
     * @psalm-param Collection<E> $collection
     *
     * @psalm-pure
     */
    public function equals(Collection $collection) : bool;

    /** @psalm-pure */
    public function isEmpty() : bool;

    /**
     * @psalm-return Traversable<array-key, E>
     *
     * @psalm-pure
     */
    public function getIterator() : Traversable;

    /** @psalm-pure */
    public function count() : int;

    /**
     * @psalm-return array<array-key, E>
     * @return array<int|string, object>
     *
     * @psalm-pure
     */
    public function toArray() : array;

    public function clear() : void;
}
