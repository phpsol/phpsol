<?php

declare(strict_types=1);

namespace Phpsol\Collection;

use ArrayIterator;
use Phpsol\Collection\Exception\ElementNotFound;
use Phpsol\Collection\Exception\IndexOutOfBounds;
use Phpsol\Configuration\Phpsol;
use Phpsol\Generic\Generic;
use Phpsol\Generic\Template;
use Phpsol\Generic\Type;
use Traversable;
use function array_splice;
use function array_values;
use function count;
use function is_int;

/**
 * @template E
 *
 * @template-implements Sequence<E>
 *
 * @psalm-external-mutation-free
 */
final class ArraySequence implements Sequence
{
    use Generic;

    private const TEMPLATE_E = 'E';

    /**
     * @psalm-var list<E>
     * @var array<int, mixed>
     */
    private array $elements;

    /**
     * @psalm-param array<array-key, E> $elements
     *
     * @param array<int|string, mixed> $elements
     */
    public function __construct(array $elements = [], ?Type $elementType = null)
    {
        if ($elementType !== null) {
            $this->__template(self::TEMPLATE_E)->initialize($elementType);
        }

        $this->__template(self::TEMPLATE_E)->matchAll($elements);

        $this->elements = array_values($elements);
    }

    /**
     * @inheritDoc
     */
    protected static function __templateDefinitions() : array
    {
        return [
            self::TEMPLATE_E => Template::mixed(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function add($element) : void
    {
        $this->__template(self::TEMPLATE_E)->match($element);

        $this->elements[] = $element;
    }

    /**
     * @inheritDoc
     */
    public function addAt(int $index, $element) : void
    {
        $this->__template(self::TEMPLATE_E)->match($element);

        $size = $this->count();
        if ($index < 0 || $index > $size) {
            throw IndexOutOfBounds::create($index, $size);
        }

        array_splice($this->elements, $index, 0, [$element]);
    }

    /**
     * @inheritDoc
     */
    public function get(int $index)
    {
        $size = $this->count();
        if ($index < 0 || $index >= $size) {
            throw IndexOutOfBounds::create($index, $size - 1);
        }

        return $this->elements[$index];
    }

    /**
     * @inheritDoc
     */
    public function remove($element) : void
    {
        $this->__template(self::TEMPLATE_E)->match($element);

        if (!$this->contains($element)) {
            throw ElementNotFound::create();
        }

        $this->removeAt($this->indexOf($element));
    }

    /**
     * @inheritDoc
     */
    public function removeAt(int $index) : void
    {
        $size = $this->count();
        if ($index < 0 || $index >= $size) {
            throw IndexOutOfBounds::create($index, $size - 1);
        }

        array_splice($this->elements, $index, 1);
    }

    /**
     * @inheritDoc
     */
    public function indexOf($element) : int
    {
        $this->__template(self::TEMPLATE_E)->match($element);

        foreach ($this->elements as $index => $_element) {
            if ($_element === $element) {
                return $index;
            }
        }

        throw ElementNotFound::create();
    }

    /**
     * @inheritDoc
     *
     * @psalm-param E $element
     */
    public function contains($element) : bool
    {
        $this->__template(self::TEMPLATE_E)->match($element);

        foreach ($this->elements as $_element) {
            if ($_element === $element) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function equals(Collection $collection) : bool
    {
        if ($collection->count() !== $this->count()) {
            return false;
        }

        foreach ($collection->getIterator() as $index => $element) {
            if (!is_int($index)) {
                return false;
            }

            if (!isset($this->elements[$index])) {
                return false;
            }
            if ($this->get($index) !== $element) {
                return false;
            }
        }

        return true;
    }

    public function isEmpty() : bool
    {
        return $this->count() === 0;
    }

    /**
     * @inheritDoc
     */
    public function getIterator() : Traversable
    {
        return new ArrayIterator($this->toArray());
    }

    public function count() : int
    {
        return count($this->elements);
    }

    public function clear() : void
    {
        $this->elements = [];
    }

    /**
     * @inheritDoc
     */
    public function toArray() : array
    {
        return array_values($this->elements);
    }
}
