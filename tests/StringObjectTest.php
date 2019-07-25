<?php

declare(strict_types=1);

namespace Phpsol\Tests;

use Phpsol\StringObject;
use PHPUnit\Framework\TestCase;

final class StringObjectTest extends TestCase
{
    public function testValue() : void
    {
        $value = 'string';

        $stringObject = new StringObject($value);

        self::assertSame($value, $stringObject->value());
    }

    public function testEquals() : void
    {
        $sameA = new StringObject('same');
        $sameB = new StringObject('same');
        $different = new StringObject('different');

        self::assertTrue($sameA->equals($sameB));
        self::assertTrue($sameB->equals($sameA));
        self::assertFalse($sameA->equals($different));
        self::assertFalse($different->equals($sameA));
    }

    public function testExplode() : void
    {
        $stringObject = new StringObject('a,b');

        $exploded = $stringObject->explode(',');
        self::assertCount(2, $exploded);
        self::assertSame('a', $exploded[0]);
        self::assertSame('b', $exploded[1]);
    }

    public function testToString() : void
    {
        $value = 'string';

        $stringObject = new StringObject($value);

        self::assertEquals($value, $stringObject);
        self::assertSame($value, (string) $stringObject);
        self::assertSame($value, $stringObject->__toString());
    }
}
