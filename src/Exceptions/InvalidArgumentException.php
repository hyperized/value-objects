<?php

namespace Hyperized\ValueObjects\Exceptions;

use Hyperized\ValueObjects\Abstracts\Integers\Octal;

class InvalidArgumentException extends \InvalidArgumentException
{
    public static function negativeInteger(): InvalidArgumentException
    {
        return new self('Integer is not larger than 0 (zero)');
    }

    public static function positiveInteger(): InvalidArgumentException
    {
        return new self('Integer is not smaller than 0 (zero)');
    }

    public static function notAnOctal(): InvalidArgumentException
    {
        return new self('Integer is not an octal value');
    }
}