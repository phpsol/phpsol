<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set;

use Countable;
use IteratorAggregate;
use Phpsol\Collection\Set\Exception\DuplicateElement;

/**
 * A collection of unique elements.
 *
 * @template E as object
 * @template-extends IteratorAggregate<array-key, E>
 */
interface Set extends IteratorAggregate, Countable
{
    /**
     * @psalm-param E $element
     *
     * @throws DuplicateElement
     */
    public function add(object $element) : void;

    /**
     * @psalm-param E $element
     */
    public function remove(object $element) : void;

    public function clear() : void;

    /**
     * @psalm-param E $element
     */
    public function contains(object $element) : bool;

    /**
     * @psalm-param Set<E> $set
     */
    public function equals(self $set) : bool;

    public function isEmpty() : bool;

    /**
     * @psalm-return array<array-key, E>
     * @return array<int|string, object>
     */
    public function toArray() : array;
}
