<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Countable;
use IteratorAggregate;

/**
 * @template T of object
 */
interface Collection extends IteratorAggregate, Countable
{
    /**
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

    public function equals(self $collection) : bool;

    public function isEmpty() : bool;

    /**
     * @return object[]
     *
     * @psalm-return array<T>
     */
    public function toArray() : array;
}
