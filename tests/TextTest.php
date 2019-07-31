<?php

declare(strict_types=1);

namespace Phpsol\Tests;

use Phpsol\Text;
use PHPUnit\Framework\TestCase;

final class TextTest extends TestCase
{
    public function testValue() : void
    {
        $value = 'string';

        $text = new Text($value);

        self::assertSame($value, $text->value());
    }

    public function testEquals() : void
    {
        $sameA = new Text('same');
        $sameB = new Text('same');
        $different = new Text('different');

        self::assertTrue($sameA->equals($sameB));
        self::assertTrue($sameB->equals($sameA));
        self::assertFalse($sameA->equals($different));
        self::assertFalse($different->equals($sameA));
    }

    public function testExplode() : void
    {
        $text = new Text('a,b');

        $parts = $text->explode(',');

        self::assertCount(2, $parts);

        self::assertSame(\get_class($parts[0]), Text::class);
        self::assertEquals(new Text('a'), $parts[0]);

        self::assertSame(\get_class($parts[1]), Text::class);
        self::assertEquals(new Text('b'), $parts[1]);
    }

    public function testToString() : void
    {
        $value = 'string';

        $text = new Text($value);

        self::assertEquals($value, $text);
        self::assertSame($value, (string) $text);
        self::assertSame($value, $text->__toString());
    }
}
