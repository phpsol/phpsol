<?php

declare(strict_types=1);

namespace Phpsol\Generic\Tests;

use Phpsol\Generic\Exception\MismatchedTemplate;
use Phpsol\Generic\Template;
use Phpsol\Generic\Type;
use PHPUnit\Framework\TestCase;

final class TemplateTest extends TestCase
{
    public function testInitialize() : void
    {
        $template = Template::mixed();
        $template->initialize('');

        $this->addToAssertionCount(1);
    }

    public function testInitializeMismatchedTemplateException() : void
    {
        $type = $this->createStub(Type::class);
        $type->method('isAssignable')->willReturn(false);

        $template = Template::as($type);

        $this->expectException(MismatchedTemplate::class);
        $template->initialize('');
    }

    public function testMatch() : void
    {
        $template = Template::mixed();

        self::assertTrue($template->match('value'));
    }

    public function testMatchWithInitialize() : void
    {
        $template = Template::mixed();

        $template->initialize('');
        self::assertTrue($template->match(''));

        $template->initialize(1);
        self::assertFalse($template->match(''));
    }

    public function testMatchAll() : void
    {
        $template = Template::mixed();

        self::assertTrue($template->matchAll(['', '']));
    }

    public function testMatchAllWithInitialize() : void
    {
        $template = Template::mixed();

        $template->initialize('');
        self::assertTrue($template->matchAll(['', '']));

        $template->initialize(1);
        self::assertFalse($template->matchAll([1, '']));
    }
}