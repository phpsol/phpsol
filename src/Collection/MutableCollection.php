<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Phpsol\Collection\Exception\ElementNotFound;

/**
 * @template E
 *
 * @template-extends Collection<E>
 *
 * @psalm-external-mutation-free
 */
interface MutableCollection extends Collection
{
    /**
     * @psalm-param E $element
     * @param mixed $element
     */
    public function add($element) : void;

    public function clear() : void;

    /**
     * @psalm-param E $element
     * @param mixed $element
     *
     * @throws ElementNotFound If the element is not found in the sequence.
     */
    public function remove($element) : void;
}
