<?php

declare(strict_types=1);

namespace Phpsol\Text\Tests;

use Phpsol\Text\Text;
use PHPUnit\Framework\TestCase;

final class TextTest extends TestCase
{
    public function testValue() : void
    {
        $value = 'value';

        $text = new Text($value);

        self::assertSame($value, $text->toString());
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
        self::assertEquals($a . $b, $concatenated->toString());
    }

    public function testContains() : void
    {
        $text = new Text('value');

        self::assertTrue($text->contains(new Text('a')));
        self::assertTrue($text->contains(new Text('value')));
        self::assertFalse($text->contains(new Text('b')));
        self::assertFalse($text->contains(new Text('valuea')));
        self::assertFalse($text->contains(new Text('Value')));
    }

    public function testLength() : void
    {
        $text = new Text('value');

        self::assertSame(5, $text->length());
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

        $parts = $text->split(new Text(','));

        self::assertCount(2, $parts);

        self::assertSame(Text::class, \get_class($parts[0]));
        self::assertEquals(new Text('a'), $parts[0]);

        self::assertSame(Text::class, \get_class($parts[1]));
        self::assertEquals(new Text('b'), $parts[1]);
    }

    public function testToString() : void
    {
        $value = 'value';

        $text = new Text($value);

        self::assertEquals($value, $text);
        self::assertSame($value, (string) $text);
        self::assertSame($value, $text->__toString());
    }
}
