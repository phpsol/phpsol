<?php

declare(strict_types=1);

namespace Phpsol\Generic\Tests\Type;

use Phpsol\Generic\Type;
use Phpsol\Generic\Type\TClass;
use Phpsol\Generic\Type\TMixed;
use Phpsol\Generic\Type\TObject;
use PHPUnit\Framework\TestCase;

final class TClassTest extends TestCase
{
    /**
     * @dataProvider isAssignableDataProvider
     *
     * @psalm-param class-string $class
     */
    public function testIsAssignable(Type $type, string $class, bool $isAssignable) : void
    {
        self::assertSame($isAssignable, (new TClass($class))->isAssignable($type));
    }

    /**
     * @psalm-return array<string, array{Type, class-string, bool}>
     * @return array<string, array<mixed>>
     */
    public function isAssignableDataProvider() : array
    {
        return [
            'mixed' => [new TMixed(), TClass::class, true],
            'object' => [new TObject(), TClass::class, true],
            'class_assignable' => [new TClass(Type::class), TClass::class, true],
            'class_not_assignable' => [new TClass(TObject::class), TClass::class, false],
            'other' => [$this->createStub(Type::class), TClass::class, false],
        ];
    }
}