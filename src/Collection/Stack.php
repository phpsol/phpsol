<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Phpsol\Collection\Stack\Exception\EmptyStack;

/**
 * A first in, last out collection.
 *
 * @template E
 *
 * @template-extends Collection<E>
 *
 * @psalm-external-mutation-free
 */
interface Stack extends Collection
{
    /**
     * Returns the element at the top of the stack without removing it.
     *
     * @psalm-return E
     * @return mixed
     *
     * @throws EmptyStack when the stack contains no elements.
     */
    public function peek();

    /**
     * Removes and returns the element at the top of the stack.
     *
     * @psalm-return E
     * @return mixed
     *
     * @throws EmptyStack when the stack contains no elements.
     */
    public function pop();

    /**
     * Pushes an element on top of the stack.
     *
     * @psalm-param E $element
     * @param mixed $element
     */
    public function push($element) : void;
}
