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

    public function testConcatenate() : void
    {
        $a = new Text('a');
        $b = new Text('b');

        $concatenated = $a->concatenate($b);

        self::assertSame(Text::class, \get_class($concatenated));
        self::assertEquals($a . $b, $concatenated->value());
    }

    public function testContains() : void
    {
        $text = new Text('text');

        self::assertTrue($text->contains(new Text('e')));
        self::assertTrue($text->contains(new Text('text')));
        self::assertFalse($text->contains(new Text('a')));
        self::assertFalse($text->contains(new Text('texta')));
        self::assertFalse($text->contains(new Text('Text')));
    }

    public function testLength() : void
    {
        $text = new Text('text');

        self::assertSame(4, $text->length());
    }

    public function testReplace() : void
    {
        $text = new Text('a_A_a');

        $replaced = $text->replace(new Text('a'), new Text('b'));

        self::assertEquals(new Text('b_A_b'), $replaced);
    }

    public function testSplit() : void
    {
        $text = new Text('a,b');

        $parts = $text->split(',');

        self::assertCount(2, $parts);

        self::assertSame(Text::class, \get_class($parts[0]));
        self::assertEquals(new Text('a'), $parts[0]);

        self::assertSame(Text::class, \get_class($parts[1]));
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
