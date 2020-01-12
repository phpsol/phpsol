<?php

declare(strict_types=1);

namespace Phpsol\Collection;

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
     */
    public function remove($element) : void;
}
