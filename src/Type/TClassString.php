<?php

declare(strict_types=1);

namespace Phpsol\Type;

use InvalidArgumentException;
use function class_exists;
use function interface_exists;
use function sprintf;

final class TClassString implements Type
{
    /**
     * @psalm-var class-string|null
     */
    private ?string $class;

    /**
     * @psalm-param class-string|null $class
     */
    public function __construct(?string $class = null)
    {
        if ($class !== null && !class_exists($class) && !interface_exists($class)) {
            throw new InvalidArgumentException(sprintf('Expected a class-string. Got: %s', $class));
        }

        $this->class = $class;
    }

    public function toString() : string
    {
        if ($this->class !== null) {
            return sprintf('class-string<%s>', $this->class);
        }

        return 'class-string';
    }

    public function parent() : ?Type
    {
        return new TString();
    }
}
