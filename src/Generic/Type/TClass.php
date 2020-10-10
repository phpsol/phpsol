<?php

declare(strict_types=1);

namespace Phpsol\Generic\Type;

use InvalidArgumentException;
use Phpsol\Generic\Type;

use function class_exists;
use function interface_exists;
use function is_a;
use function sprintf;

final class TClass implements Type
{
    /**
     * @psalm-var class-string
     */
    private string $class;

    /**
     * @psalm-param class-string $class
     */
    public function __construct(string $class)
    {
        if (!class_exists($class) && !interface_exists($class)) {
            throw new InvalidArgumentException(sprintf('Expected a class-string. Got: %s', $class));
        }

        $this->class = $class;
    }

    public function toString() : string
    {
        return $this->class;
    }

    public function isAssignable(Type $type) : bool
    {
        if ($type instanceof self) {
            return is_a($this->toString(), $type->toString(), true);
        }

        return (new TObject())->isAssignable($type);
    }
}
