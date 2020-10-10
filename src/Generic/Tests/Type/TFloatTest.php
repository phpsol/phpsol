<?php

declare(strict_types=1);

namespace Phpsol\Generic\Tests\Type;

use Phpsol\Generic\Type;
use Phpsol\Generic\Type\TFloat;
use Phpsol\Generic\Type\TMixed;
use Phpsol\Generic\Type\TScalar;
use PHPUnit\Framework\TestCase;

final class TFloatTest extends TestCase
{
    /**
     * @dataProvider isAssignableDataProvider
     */
    public function testIsAssignable(Type $type, bool $isAssignable) : void
    {
        self::assertSame($isAssignable, (new TFloat())->isAssignable($type));
    }

    /**
     * @psalm-return array<string, array{Type, bool}>
     * @return array<string, array<mixed>>
     */
    public function isAssignableDataProvider() : array
    {
        return [
            'mixed' => [new TMixed(), true],
            'scalar' => [new TScalar(), true],
            'float' => [new TFloat(), true],
            'other' => [$this->createStub(Type::class), false],
        ];
    }
}