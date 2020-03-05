<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Phpsol\Collection\Stack\Exception\EmptyStack;

/**
 * A first in, last out collection.
 *
 * @template E as object
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
     *
     * @throws EmptyStack when the stack contains no elements.
     */
    public function peek() : object;

    /**
     * Removes and returns the element at the top of the stack.
     *
     * @psalm-return E
     *
     * @throws EmptyStack when the stack contains no elements.
     */
    public function pop() : object;

    /**
     * Pushes an element on top of the stack.
     *
     * @psalm-param E $element
     */
    public function push(object $element) : void;
}
