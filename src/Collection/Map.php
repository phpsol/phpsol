<?php

declare(strict_types=1);

namespace Phpsol\Collection;

/**
 * @template K as object
 * @template E as object
 *
 * @template-extends Collection<KeyValuePair<K, E>>
 *
 * @psalm-external-mutation-free
 */
interface Map extends Collection
{
    /**
     * @psalm-param KeyValuePair<K, E> $keyValuePair
     */
    public function add(KeyValuePair $keyValuePair) : void;

    /**
     * @psalm-param K $key
     *
     * @psalm-return E $element
     */
    public function get(object $key) : object;

    /**
     * @psalm-param K $key
     */
    public function remove(object $key) : void;
}
