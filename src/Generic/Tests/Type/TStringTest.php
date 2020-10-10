<?php

declare(strict_types=1);

namespace Phpsol\Generic\Tests\Type;

use Phpsol\Generic\Type;
use Phpsol\Generic\Type\TMixed;
use Phpsol\Generic\Type\TScalar;
use Phpsol\Generic\Type\TString;
use PHPUnit\Framework\TestCase;

final class TStringTest extends TestCase
{
    /**
     * @dataProvider isAssignableDataProvider
     */
    public function testIsAssignable(Type $type, bool $isAssignable) : void
    {
        self::assertSame($isAssignable, (new TString())->isAssignable($type));
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
            'string' => [new TString(), true],
            'other' => [$this->createStub(Type::class), false],
        ];
    }
}