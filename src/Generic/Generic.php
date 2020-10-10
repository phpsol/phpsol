<?php

declare(strict_types=1);

namespace Phpsol\Generic;

use Phpsol\Generic\Exception\UndefinedTemplate;
use function array_key_exists;

trait Generic
{
    /**
     * @throws UndefinedTemplate
     */
    final protected function __template(string $name) : Template
    {
        if (!array_key_exists($name, $this->__templates())) {
            throw UndefinedTemplate::withName($name);
        }

        return $this->__templates()[$name];
    }

    /**
     * @return array<string, Template>
     */
    abstract protected function __templates() : array;
}
