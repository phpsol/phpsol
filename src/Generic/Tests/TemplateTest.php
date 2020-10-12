<?php

declare(strict_types=1);

namespace Phpsol\Generic\Tests;

use Phpsol\Generic\Exception\MismatchedTemplate;
use Phpsol\Generic\Template;
use Phpsol\Generic\Type;
use Phpsol\Generic\Type\TInteger;
use Phpsol\Generic\Type\TString;
use PHPUnit\Framework\TestCase;

final class TemplateTest extends TestCase
{
    public function testInitialize() : void
    {
        $template = Template::mixed();
        $template->initialize(new TString());

        $this->addToAssertionCount(1);
    }

    public function testInitializeMismatchedTemplateException() : void
    {
        $type = $this->createStub(Type::class);
        $type->method('isAssignable')->willReturn(false);

        $template = Template::as($type);

        $this->expectException(MismatchedTemplate::class);
        $template->initialize(new TString());
    }

    public function testMatch() : void
    {
        $template = Template::mixed();

        $template->match('value');
        $this->addToAssertionCount(1);
    }

    public function testMatchWithInitialize() : void
    {
        $template = Template::mixed();
        $template->initialize(new TString());
        $template->match('');
        $this->addToAssertionCount(1);

        $template = Template::mixed();
        $template->initialize(new TInteger());
        $this->expectException(MismatchedTemplate::class);
        $template->match('');
    }

    public function testMatchAll() : void
    {
        $template = Template::mixed();

        $template->matchAll(['', '']);
        $this->addToAssertionCount(1);
    }

    public function testMatchAllWithInitialize() : void
    {
        $template = Template::mixed();
        $template->initialize(new TString());
        $template->matchAll(['', '']);
        $this->addToAssertionCount(1);

        $template = Template::mixed();
        $template->initialize(new TInteger());
        $this->expectException(MismatchedTemplate::class);
        $template->matchAll([1, '']);
    }
}