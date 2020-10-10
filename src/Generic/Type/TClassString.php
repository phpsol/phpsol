<?php

declare(strict_types=1);

namespace Phpsol\Generic\Type;

use InvalidArgumentException;
use Phpsol\Generic\Type;

use function class_exists;
use function interface_exists;
use function sprintf;

final class TClassString implements Type
{
    private ?TClass $template;

    /**
     * @psalm-param class-string|null $class
     */
    public function __construct(?string $class = null)
    {
        if ($class !== null && !class_exists($class) && !interface_exists($class)) {
            throw new InvalidArgumentException(sprintf('Expected a class-string. Got: %s', $class));
        }

        $this->template = $class !== null ? new TClass($class) : null;
    }

    public function toString() : string
    {
        if ($this->template !== null) {
            return sprintf('class-string<%s>', $this->template->toString());
        }

        return 'class-string';
    }

    public function template() : ?TClass
    {
        return $this->template;
    }

    public function isAssignable(Type $type) : bool
    {
        if ($type instanceof self) {
            if ($this->template !== null) {
               return $type->template() !== null && $this->template->isAssignable($type->template());
            }

            return true;
        }

        return (new TString())->isAssignable($type);
    }
}
