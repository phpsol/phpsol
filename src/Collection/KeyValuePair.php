<?php

declare(strict_types=1);

namespace Phpsol\Collection;

/**
 * @template K as object
 * @template V as object
 *
 * @psalm-pure
 */
final class KeyValuePair
{
    /**
     * @psalm-var K
     * @var object
     */
    private $key;

    /**
     * @psalm-var V
     * @var object
     */
    private $value;

    /**
     * @psalm-param K $key
     * @psalm-param V $value
     */
    public function __construct(object $key, object $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @psalm-return K
     */
    public function key() : object
    {
        return $this->key;
    }

    /**
     * @psalm-return V
     */
    public function value() : object
    {
        return $this->value;
    }
}
