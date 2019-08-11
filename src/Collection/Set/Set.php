<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set;

use Countable;
use IteratorAggregate;
use Phpsol\Collection\Set\Exception\DuplicateElement;

/**
 * A collection of unique elements.
 *
 * @template TKey
 * @template TValue as object
 * @template-extends IteratorAggregate<TKey, TValue>
 */
interface Set extends IteratorAggregate, Countable
{
    /**
     * @param TValue $element
     *
     * @throws DuplicateElement
     */
    public function add(object $element) : void;

    /**
     * @param TValue $element
     */
    public function remove(object $element) : void;

    public function clear() : void;

    /**
     * @param TValue $element
     */
    public function contains(object $element) : bool;

    /**
     * @param Set<TKey, TValue> $set
     */
    public function equals(self $set) : bool;

    public function isEmpty() : bool;

    /**
     * @return array<TKey, TValue>
     */
    public function toArray() : array;
}
