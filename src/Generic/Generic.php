<?php

declare(strict_types=1);

namespace Phpsol\Generic;

use Phpsol\Generic\Exception\UndefinedTemplate;

use function array_key_exists;

/**
 * @psalm-external-mutation-free
 */
trait Generic
{
    /**
     * @var array<string, Template>
     */
    private array $__templates = [];

    /**
     * @return array<string, Template>
     */
    abstract protected static function __templateDefinitions() : array;

    /**
     * @throws UndefinedTemplate
     */
    final protected function __template(string $name) : Template
    {
        if (!array_key_exists($name, static::__templateDefinitions())) {
            throw UndefinedTemplate::withName($name);
        }

        if (!isset($this->__templates[$name])) {
            $this->__templates[$name] = static::__templateDefinitions()[$name];
        }

        return $this->__templates[$name];
    }
}
