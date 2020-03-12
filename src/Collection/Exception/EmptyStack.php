<?php

declare(strict_types=1);

namespace Phpsol\Collection\Stack\Exception;

use UnexpectedValueException;

/**
 * @psalm-external-mutation-free
 */
final class EmptyStack extends UnexpectedValueException
{
}
