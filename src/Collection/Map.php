<?php

declare(strict_types=1);

namespace Phpsol\Collection;

/**
 * @template K
 * @template E
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
     * @param mixed $key
     *
     * @psalm-return E $element
     * @return mixed
     */
    public function get($key);

    /**
     * @psalm-param K $key
     * @param mixed $key
     */
    public function remove($key) : void;
}
