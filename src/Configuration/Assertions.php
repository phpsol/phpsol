<?php

declare(strict_types=1);

namespace Phpsol\Configuration;

final class Assertions
{
    /** @var bool */
    private $enabled;

    public function __construct(bool $enabled)
    {
        $this->enabled = $enabled;
    }

    public function enable() : void
    {
        $this->enabled = true;
    }

    public function disable() : void
    {
        $this->enabled = false;
    }

    public function isEnabled() : bool
    {
        return $this->enabled;
    }
}
