<?php

declare(strict_types=1);

namespace Phpsol\Tests\Collection\Set;

use ArrayIterator;
use Phpsol\Collection\Set\Exception\DuplicateElement;
use Phpsol\Collection\Set\Exception\NonExistentClass;
use Phpsol\Collection\Set\Exception\UnexpectedType;
use Phpsol\Collection\Set\HashSet;
use PHPUnit\Framework\TestCase;
use stdClass;

final class HashSetTest extends TestCase
{
    public function testConstruct() : void
    {
        $elementA = new stdClass();
        $elementB = new stdClass();
        $set = new HashSet(stdClass::class, [$elementA, $elementB]);

        self::assertInstanceOf(ArrayIterator::class, $set->getIterator());
        self::assertTrue($set->contains($elementA));
        self::assertTrue($set->contains($elementB));
    }

    public function testConstructNonExistentClass() : void
    {
        $this->expectException(NonExistentClass::class);

        new HashSet('nonExistentClass');
    }

    public function testConstructUnexpectedType() : void
    {
        $this->expectException(UnexpectedType::class);

        new HashSet(stdClass::class, [new HashSet(stdClass::class)]);
    }

    public function testConstructDuplicateElement() : void
    {
        $element = new stdClass();

        $this->expectException(DuplicateElement::class);

        new HashSet(stdClass::class, [$element, $element]);
    }

    public function testClear() : void
    {
        $set = new HashSet(stdClass::class, [new stdClass(), new stdClass()]);

        self::assertCount(2, $set);

        $set->clear();

        self::assertCount(0, $set);
    }

    public function testEquals() : void
    {
        $elementA = new stdClass();
        $elementB = new stdClass();

        $setA = new HashSet(stdClass::class, [$elementA, $elementB]);
        $setB = new HashSet(stdClass::class, [$elementA, $elementB]);

        self::assertTrue($setA->equals($setB));
        self::assertTrue($setB->equals($setA));

        $setB = new HashSet(
            stdClass::class,
            [
                new stdClass(),
                new stdClass(),
            ]
        );

        self::assertFalse($setA->equals($setB));
        self::assertFalse($setB->equals($setA));
    }

    public function testAdd() : void
    {
        $set = new HashSet(stdClass::class);
        $element = new stdClass();

        self::assertFalse($set->contains($element));

        $set->add($element);

        self::assertTrue($set->contains($element));
    }

    public function testAddUnexpectedType() : void
    {
        $set = new HashSet(stdClass::class);

        $this->expectException(UnexpectedType::class);

        $set->add(new HashSet(stdClass::class));
    }

    public function testAddDuplicateElement() : void
    {
        $set = new HashSet(stdClass::class);
        $element = new stdClass();

        $set->add($element);

        $this->expectException(DuplicateElement::class);

        $set->add($element);
    }

    public function testContains() : void
    {
        $set = new HashSet(stdClass::class);
        $element = new stdClass();

        self::assertFalse($set->contains($element));

        $set->add($element);

        self::assertTrue($set->contains($element));
    }

    public function testRemove() : void
    {
        $set = new HashSet(stdClass::class);
        $element = new stdClass();

        $set->add($element);

        self::assertTrue($set->contains($element));

        $set->remove($element);

        self::assertFalse($set->contains($element));
    }

    public function testToArray() : void
    {
        $set = new HashSet(stdClass::class);
        $elementA = new stdClass();
        $elementB = new stdClass();

        self::assertSame([], $set->toArray());

        $set->add($elementA);
        $set->add($elementB);

        $array = $set->toArray();
        self::assertSame($elementA, $array[0]);
        self::assertSame($elementB, $array[1]);
    }

    public function testCount() : void
    {
        $set = new HashSet(stdClass::class);

        self::assertCount(0, $set);

        $set->add($this->createMock(stdClass::class));

        self::assertCount(1, $set);
    }

    public function testIsEmpty() : void
    {
        $set = new HashSet(stdClass::class);

        self::assertTrue($set->isEmpty());

        $set->add(new stdClass());

        self::assertFalse($set->isEmpty());
    }
}
