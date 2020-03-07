<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Phpsol\Collection\Exception\DuplicateElement;
use Phpsol\Collection\Exception\ElementNotFound;

/**
 * A collection of unique elements.
 *
 * @template E as object
 *
 * @template-extends Collection<E>
 *
 * @psalm-external-mutation-free
 */
interface Set extends Collection
{
    /**
     * @psalm-param E $element
     *
     * @throws DuplicateElement
     */
    public function add(object $element) : void;

    /**
     * @psalm-param E $element
     *
     * @throws ElementNotFound If the element is not found in the sequence.
     */
    public function remove(object $element) : void;

    /**
     * @psalm-return list<E>
     * @return array<int, object>
     */
    public function toArray() : array;
}
