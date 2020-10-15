<?php

declare(strict_types=1);

namespace Phpsol\Generic;

use LogicException;
use Phpsol\Configuration\Phpsol;
use Phpsol\Generic\Exception\MismatchedTemplate;
use Phpsol\Generic\Exception\TemplateAlreadyInitialized;
use Phpsol\Generic\Type\Factory;
use Phpsol\Generic\Type\TMixed;

/**
 * @psalm-external-mutation-free
 */
final class Template
{
    private Type $definition;
    private ?Type $type = null;

    private function __construct(Type $definition)
    {
        $this->definition = $definition;
    }

    public static function mixed() : self
    {
        return new self(new TMixed());
    }

    public static function as(Type $type) : self
    {
        return new self($type);
    }

    /**
     * @throws TemplateAlreadyInitialized
     * @throws MismatchedTemplate
     */
    public function initialize(Type $type) : void
    {
        if (!Phpsol::runtimeAssertions()->isEnabled()) {
            return;
        }

        if ($this->type !== null) {
            throw TemplateAlreadyInitialized::withType($this->type);
        }

        if (!$type->isAssignable($this->definition)) {
            throw MismatchedTemplate::mismatchedType($this->definition, $type);
        }

        $this->type = $type;
    }

    /**
     * @param mixed $value
     *
     * @throws TemplateAlreadyInitialized
     * @throws MismatchedTemplate
     */
    public function match($value) : void
    {
        if (!Phpsol::runtimeAssertions()->isEnabled()) {
            return;
        }

        $valueType = Factory::fromValue($value);

        if ($this->type === null) {
            $this->initialize($valueType);
        }

        if (!$valueType->isAssignable($this->type)) {
            throw MismatchedTemplate::mismatchedType($this->type, $valueType);
        }
    }

    /**
     * @param iterable<mixed> $values
     *
     * @throws TemplateAlreadyInitialized
     * @throws MismatchedTemplate
     */
    public function matchAll(iterable $values) : void
    {
        /** @var mixed $value */
        foreach ($values as $value) {
            $this->match($value);
        }
    }
}
