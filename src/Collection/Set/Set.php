<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set;

use Countable;
use IteratorAggregate;
use Phpsol\Collection\Set\Exception\DuplicateElement;

/**
 * A collection of unique elements.
 *
 * @psalm-template TKey
 * @psalm-template TValue as object
 *
 * @template-extends IteratorAggregate<TKey, TValue>
 */
interface Set extends IteratorAggregate, Countable
{
    /**
     * @psalm-param TValue $element
     *
     * @throws DuplicateElement
     */
    public function add(object $element) : void;

    /**
     * @psalm-param TValue $element
     */
    public function remove(object $element) : void;

    public function clear() : void;

    /**
     * @psalm-param TValue $element
     */
    public function contains(object $element) : bool;

    /**
     * @psalm-param Set<TKey, TValue> $set
     */
    public function equals(self $set) : bool;

    public function isEmpty() : bool;

    /**
     * @psalm-return array<int|string, TValue>
     */
    public function toArray() : array;
}
