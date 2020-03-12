<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Phpsol\Collection\Exception\DuplicateElement;
use Phpsol\Collection\Exception\ElementNotFound;

/**
 * A collection of unique elements.
 *
 * @template E
 *
 * @template-extends Collection<E>
 *
 * @psalm-external-mutation-free
 */
interface Set extends Collection
{
    /**
     * @psalm-param E $element
     * @param mixed $element
     *
     * @throws DuplicateElement
     */
    public function add($element) : void;

    /**
     * @psalm-param E $element
     * @param mixed $element
     *
     * @throws ElementNotFound If the element is not found in the sequence.
     */
    public function remove($element) : void;

    /**
     * @psalm-return list<E>
     * @return array<int, mixed>
     */
    public function toArray() : array;
}
