<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class NegativeInteger extends Integer
{
    protected static function validate(int $value): void
    {
        if ($value >= 0) {
            throw InvalidArgumentException::positiveInteger();
        }
    }
}
