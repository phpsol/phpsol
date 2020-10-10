<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use Phpsol\Collection\Exception\EmptyQueue;

/**
 * A first in, first out collection.
 *
 * @template E
 *
 * @template-extends Collection<E>
 *
 * @psalm-external-mutation-free
 */
interface Queue extends Collection
{
    /**
     * Removes and returns the element at the front of the queue.
     *
     * @psalm-return E
     * @return mixed
     *
     * @throws EmptyQueue when the stack contains no elements.
     */
    public function next();

    /**
     * Queues an element in the back of the queue.
     *
     * @psalm-param E $element
     * @param mixed $element
     */
    public function queue($element) : void;
}
