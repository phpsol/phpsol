<?php

declare(strict_types=1);

namespace Phpsol\Collection\Tests;

use Phpsol\Collection\Exception\DuplicateElement;
use Phpsol\Collection\HashSet;
use PHPUnit\Framework\TestCase;
use stdClass;

final class HashSetTest extends TestCase
{
    public function testConstruct() : void
    {
        $elementA = new stdClass();
        $elementB = new stdClass();
        $set = new HashSet([$elementA, $elementB]);

        self::assertTrue($set->contains($elementA));
        self::assertTrue($set->contains($elementB));
    }

    public function testConstructDuplicateElement() : void
    {
        $element = new stdClass();

        $this->expectException(DuplicateElement::class);

        new HashSet([$element, $element]);
    }

    public function testClear() : void
    {
        $set = new HashSet([new stdClass(), new stdClass()]);

        self::assertCount(2, $set);

        $set->clear();

        self::assertCount(0, $set);
    }

    public function testEquals() : void
    {
        $elementA = new stdClass();
        $elementB = new stdClass();

        $setA = new HashSet([$elementA, $elementB]);
        $setB = new HashSet([$elementA, $elementB]);

        self::assertTrue($setA->equals($setB));
        self::assertTrue($setB->equals($setA));

        $setB = new HashSet([new stdClass(), new stdClass()]);

        self::assertFalse($setA->equals($setB));
        self::assertFalse($setB->equals($setA));
    }

    public function testAdd() : void
    {
        /** @var HashSet<object> $set */
        $set = new HashSet();
        $element = new stdClass();

        self::assertFalse($set->contains($element));

        $set->add($element);

        self::assertTrue($set->contains($element));
    }

    public function testAddDuplicateElement() : void
    {
        /** @var HashSet<object> $set */
        $set = new HashSet();
        $element = new stdClass();

        $set->add($element);

        $this->expectException(DuplicateElement::class);

        $set->add($element);
    }

    public function testContains() : void
    {
        /** @var HashSet<object> $set */
        $set = new HashSet();
        $element = new stdClass();

        self::assertFalse($set->contains($element));

        $set->add($element);

        self::assertTrue($set->contains($element));
    }

    public function testRemove() : void
    {
        /** @var HashSet<object> $set */
        $set = new HashSet();
        $element = new stdClass();

        $set->add($element);

        self::assertTrue($set->contains($element));

        $set->remove($element);

        self::assertFalse($set->contains($element));
    }

    public function testToArray() : void
    {
        /** @var HashSet<object> $set */
        $set = new HashSet();
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
        /** @var HashSet<object> $set */
        $set = new HashSet();

        self::assertCount(0, $set);

        $set->add(new stdClass());

        self::assertCount(1, $set);
    }

    public function testIsEmpty() : void
    {
        /** @var HashSet<object> $set */
        $set = new HashSet();

        self::assertTrue($set->isEmpty());

        $set->add(new stdClass());

        self::assertFalse($set->isEmpty());
    }
}
