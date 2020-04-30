<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class RangedInteger extends Integer
{
    protected $minimum = PHP_INT_MIN;
    protected $maximum = PHP_INT_MAX;

    public static function fromRange(int $value, int $minimum, int $maximum): RangedInteger
    {
        self::validateRange($value, $minimum, $maximum);
        return new static($value);
    }

    protected static function validateRange(int $value, int $minimum, int $maximum): void {
        if ($value < $minimum || $value > $maximum) {
            throw InvalidArgumentException::outOfRange($value, $minimum, $maximum);
        }
    }
}
