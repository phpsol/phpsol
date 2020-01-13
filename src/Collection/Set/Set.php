<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set;

use Phpsol\Collection\Collection;
use Phpsol\Collection\Exception\ElementNotFound;
use Phpsol\Collection\Set\Exception\DuplicateElement;

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
     * @psalm-return array<int, E>
     *
     * @return array<int, object>
     */
    public function toArray() : array;
}
