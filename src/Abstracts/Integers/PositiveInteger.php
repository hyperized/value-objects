<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class PositiveInteger extends Integer
{
    protected static function validate(int $value): void
    {
        if ($value <= 0) {
            throw InvalidArgumentException::negativeInteger();
        }
    }
}
