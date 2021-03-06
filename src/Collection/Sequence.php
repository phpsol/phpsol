<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Phpsol\Collection\Exception\ElementNotFound;
use Phpsol\Collection\Exception\IndexOutOfBounds;

/**
 * An ordered collection.
 *
 * @template E
 *
 * @template-extends Collection<E>
 *
 * @psalm-external-mutation-free
 */
interface Sequence extends Collection
{
    /**
     * Adds the element at the end of the sequence.
     *
     * @psalm-param E $element
     * @param mixed $element
     */
    public function add($element) : void;

    /**
     * Adds element at the specified index. Shifts the element currently at that position (if any) and any
     * subsequent elements to the right (adds one to their indices).
     *
     * @psalm-param E $element
     * @param mixed $element
     *
     * @throws IndexOutOfBounds If the index is less than 0 or greater than the size of the sequence.
     */
    public function addAt(int $index, $element) : void;

    /**
     * @psalm-return E
     * @return mixed
     *
     * @throws IndexOutOfBounds If the index is less than 0 or greater than the size of the sequence.
     *
     * @psalm-pure
     */
    public function get(int $index);

    /**
     * Removes the first occurrence of the element from the sequence.
     *
     * @psalm-param E $element
     * @param mixed $element
     *
     * @throws ElementNotFound If the element is not found in the sequence.
     */
    public function remove($element) : void;

    /**
     * @throws IndexOutOfBounds If the index is less than 0 or greater than or equal to the size of the sequence.
     */
    public function removeAt(int $index) : void;

    /**
     * @psalm-param E $element
     * @param mixed $element
     *
     * @throws ElementNotFound If the element is not found in the sequence.
     *
     * @psalm-pure
     */
    public function indexOf($element) : int;

    /**
     * @psalm-return array<int, E>
     * @return array<int, mixed>
     *
     * @psalm-pure
     */
    public function toArray() : array;
}
