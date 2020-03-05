<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class PositiveInteger extends Integer
{
    protected function validate(): void
    {
        if ($this->value <= 0) {
            throw InvalidArgumentException::negativeInteger();
        }
    }
}