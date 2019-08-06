<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Countable;
use IteratorAggregate;
use Phpsol\Collection\Exception\DuplicateElement;
use Phpsol\Collection\Exception\UnexpectedType;

/**
 * @template T of object
 */
interface Collection extends IteratorAggregate, Countable
{
    /**
     * @throws DuplicateElement
     * @throws UnexpectedType
     *
     * @psalm-param T $element
     */
    public function add(object $element) : void;

    /**
     * @psalm-param T $element
     */
    public function remove(object $element) : void;

    public function clear() : void;

    /**
     * @psalm-param T $element
     */
    public function contains(object $element) : bool;

    /**
     * Checks if all elements in the collection are identical (strict comparison)
     * and if all elements exist in the same order.
     */
    public function equals(self $collection) : bool;

    public function isEmpty() : bool;

    /**
     * @return object[]
     *
     * @psalm-return array<T>
     */
    public function toArray() : array;
}
