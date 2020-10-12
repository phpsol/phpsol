<?php

declare(strict_types=1);

namespace Phpsol\Generic\Tests;

use Phpsol\Generic\Exception\MismatchedTemplate;
use Phpsol\Generic\Generic;
use Phpsol\Generic\Template;
use Phpsol\Generic\Type;
use Phpsol\Generic\Type\TString;
use PHPUnit\Framework\TestCase;

final class GenericTest extends TestCase
{
    public function testMatchWithInitialize() : void
    {
        $genericClass = new /** @template T */ class(new TString()) {
            use Generic;

            public function __construct(Type $__T)
            {
                $this->__template('T')->initialize($__T);
            }

            /**
             * @psalm-param T $value
             *
             * @param mixed $value
             */
            public function doSomethingGeneric($value) : void
            {
                $this->__template('T')->match($value);

                // do something
            }


            protected static function __templateDefinitions() : array
            {
                return ['T' => Template::mixed()];
            }
        };
        
        $genericClass->doSomethingGeneric('');
        $this->addToAssertionCount(1);

        $this->expectException(MismatchedTemplate::class);
        $genericClass->doSomethingGeneric(1);
    }

    public function testMatchAllWithInitialize() : void
    {
        $genericClass = new /** @template T */ class(new TString()) {
            use Generic;

            public function __construct(Type $__T)
            {
                $this->__template('T')->initialize($__T);
            }

            /**
             * @psalm-param array<array-key, T> $values
             *
             * @param array<int|string, mixed> $values
             */
            public function doSomethingGeneric(array $values) : void
            {
                $this->__template('T')->matchAll($values);

                // do something
            }


            protected static function __templateDefinitions() : array
            {
                return ['T' => Template::mixed()];
            }
        };

        $genericClass->doSomethingGeneric(['', '']);
        $this->addToAssertionCount(1);

        $this->expectException(MismatchedTemplate::class);
        $genericClass->doSomethingGeneric(['', 1]);
    }
}