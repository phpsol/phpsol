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

    public function testToString() : void
    {
        $value = 'string';

        $stringObject = new StringObject($value);

        self::assertEquals($value, $stringObject);
        self::assertSame($value, (string) $stringObject);
        self::assertSame($value, $stringObject->__toString());
    }
}
