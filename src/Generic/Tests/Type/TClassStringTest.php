<?php

declare(strict_types=1);

namespace Phpsol\Generic\Tests\Type;

use Phpsol\Generic\Type;
use Phpsol\Generic\Type\TClassString;
use Phpsol\Generic\Type\TMixed;
use Phpsol\Generic\Type\TObject;
use Phpsol\Generic\Type\TScalar;
use Phpsol\Generic\Type\TString;
use PHPUnit\Framework\TestCase;

final class TClassStringTest extends TestCase
{
    /**
     * @dataProvider isAssignableDataProvider
     *
     * @psalm-param class-string|null $class
     */
    public function testIsAssignable(Type $type, ?string $class, bool $isAssignable) : void
    {
        self::assertSame($isAssignable, (new TClassString($class))->isAssignable($type));
    }

    /**
     * @psalm-return array<string, array{Type, class-string|null, bool}>
     * @return array<string, array<mixed>>
     */
    public function isAssignableDataProvider() : array
    {
        return [
            'mixed' => [new TMixed(), null, true],
            'scalar' => [new TScalar(), null, true],
            'string' => [new TString(), null, true],
            'class-string' => [new TClassString(), null, true],
            'class-string_assignable' => [new TClassString(Type::class), TClassString::class, true],
            'class-string_not_assignable' => [new TClassString(TObject::class), TClassString::class, false],
            'other' => [$this->createStub(Type::class), null, false],
        ];
    }
}