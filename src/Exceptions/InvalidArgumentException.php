<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Exceptions;

class InvalidArgumentException extends \InvalidArgumentException
{
    public static function negativeInteger(): InvalidArgumentException
    {
        return new self('Integer is smaller than 0 (zero)');
    }

    public static function positiveInteger(): InvalidArgumentException
    {
        return new self('Integer is larger than 0 (zero)');
    }

    public static function notAnOctal(): InvalidArgumentException
    {
        return new self('Integer is not an octal value');
    }

    public static function outOfRange(int $value, int $minimum, int $maximum): InvalidArgumentException
    {
        return new self("Integer out of range (given: $value, range: $minimum-$maximum)");
    }

    public static function emptyString(): InvalidArgumentException
    {
        return new self('Byte array cannot be empty');
    }

    public static function nonEmptyString(): InvalidArgumentException
    {
        return new self('Byte array is not empty');
    }
}
