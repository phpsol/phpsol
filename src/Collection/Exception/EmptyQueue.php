<?php

declare(strict_types=1);

namespace Phpsol\Collection\Exception;

use UnexpectedValueException;

/**
 * @psalm-external-mutation-free
 */
final class EmptyQueue extends UnexpectedValueException
{
}
