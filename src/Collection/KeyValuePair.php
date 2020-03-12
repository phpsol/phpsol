<?php

declare(strict_types=1);

namespace Phpsol\Collection;

/**
 * @template K
 * @template V
 *
 * @psalm-pure
 */
final class KeyValuePair
{
    /**
     * @psalm-var K
     * @var mixed
     */
    private $key;

    /**
     * @psalm-var V
     * @var mixed
     */
    private $value;

    /**
     * @psalm-param K $key
     * @psalm-param V $value
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @psalm-return K
     * @return mixed
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * @psalm-return V
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }
}
