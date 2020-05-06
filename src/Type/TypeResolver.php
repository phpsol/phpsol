<?php

declare(strict_types=1);

namespace Phpsol\Type;

use function class_exists;
use function get_class;
use function interface_exists;
use function is_array;
use function is_bool;
use function is_float;
use function is_int;
use function is_object;
use function is_string;

final class TypeResolver
{
    /**
     * @param mixed $value
     */
    public static function resolve($value) : Type
    {
        if ($value === null) {
            return new TNull();
        }

        if (is_bool($value)) {
            return new TBoolean();
        }

        if (is_int($value)) {
            return new TInteger();
        }

        if (is_float($value)) {
            return new TFloat();
        }

        if (is_string($value)) {
            if (class_exists($value) || interface_exists($value)) {
                return new TClassString($value);
            }

            return new TString();
        }

        if (is_array($value)) {
            return new TArray();
        }

        if (is_object($value)) {
            return new TClass(get_class($value));
        }

        return new TMixed();
    }

    public static function isOf(Type $source, Type $target) : bool
    {
        if (get_class($source) === get_class($target)) {
            return true;
        }

        if ($source->parent() === null) {
            return false;
        }

        return self::isOf($source->parent(), $target);
    }
}
