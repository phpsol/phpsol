<?php

declare(strict_types=1);

namespace Phpsol\Collection\Queue;

use Phpsol\Collection\Collection;

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
     *
     * @return mixed
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
