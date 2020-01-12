<?php

declare(strict_types=1);

namespace Phpsol\Collection\Set;

use Phpsol\Collection\MutableCollection;
use Phpsol\Collection\Set\Exception\DuplicateElement;

/**
 * A collection of unique objects.
 *
 * @template E as object
 *
 * @template-extends MutableCollection<E>
 *
 * @psalm-external-mutation-free
 */
interface Set extends MutableCollection
{
    /**
     * @inheritDoc
     *
     * @throws DuplicateElement
     */
    public function add($element) : void;

    /**
     * @psalm-return array<int, E>
     *
     * @return array<int, object>
     */
    public function toArray() : array;
}
