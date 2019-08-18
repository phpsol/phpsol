<?php

declare(strict_types=1);

namespace Phpsol\Tests;

use Phpsol\Text;
use PHPUnit\Framework\TestCase;
use function get_class;

final class TextTest extends TestCase
{
    public function testValue() : void
    {
        $value = 'value';

        $text = Text::fromString($value);

        self::assertSame($value, $text->toString());
    }

    public function testEquals() : void
    {
        $sameA = Text::fromString('same');
        $sameB = Text::fromString('same');
        $different = Text::fromString('different');

        self::assertTrue($sameA->equals($sameB));
        self::assertTrue($sameB->equals($sameA));
        self::assertFalse($sameA->equals($different));
        self::assertFalse($different->equals($sameA));
    }

    public function testConcatenate() : void
    {
        $a = Text::fromString('a');
        $b = Text::fromString('b');

        $concatenated = $a->concatenate($b);

        self::assertSame(Text::class, get_class($concatenated));
        self::assertEquals($a . $b, $concatenated->toString());
    }

    public function testContains() : void
    {
        $text = Text::fromString('value');

        self::assertTrue($text->contains(Text::fromString('a')));
        self::assertTrue($text->contains(Text::fromString('value')));
        self::assertFalse($text->contains(Text::fromString('b')));
        self::assertFalse($text->contains(Text::fromString('valuea')));
        self::assertFalse($text->contains(Text::fromString('Value')));
    }

    public function testLength() : void
    {
        $text = Text::fromString('value');

        self::assertSame(5, $text->length());
    }

    public function testReplace() : void
    {
        $text = Text::fromString('a_A_a');

        $replaced = $text->replace(Text::fromString('a'), Text::fromString('b'));

        self::assertEquals(Text::fromString('b_A_b'), $replaced);
    }

    public function testSplit() : void
    {
        $text = Text::fromString('a,b');

        $parts = $text->split(Text::fromString(','));

        self::assertCount(2, $parts);

        self::assertSame(Text::class, get_class($parts[0]));
        self::assertEquals(Text::fromString('a'), $parts[0]);

        self::assertSame(Text::class, get_class($parts[1]));
        self::assertEquals(Text::fromString('b'), $parts[1]);
    }

    public function testToString() : void
    {
        $value = 'value';

        $text = Text::fromString($value);

        self::assertEquals($value, $text);
        self::assertSame($value, (string) $text);
        self::assertSame($value, $text->toString());
        self::assertSame($value, $text->__toString());
    }
}
