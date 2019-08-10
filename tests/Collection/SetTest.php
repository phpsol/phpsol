<?php

declare(strict_types=1);

namespace Phpsol\Tests\Collection;

use Phpsol\Collection\Set\HashSet;
use Phpsol\Text\Text;
use PHPUnit\Framework\TestCase;

final class SetTest extends TestCase
{
    public function fooTest() : void
    {
        /** @var HashSet<Text> $set */
        $set = new HashSet();

        $set->add(Text::fromString('bla'));

        $array = $set->toArray();

        foreach ($array as $item) {
            $item->
        }
    }
}
