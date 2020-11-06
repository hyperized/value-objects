<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractEmptyByteArray extends AbstractByteArray
{
    protected static function validate(string $value): void
    {
        if ('' !== $value) {
            throw InvalidArgumentException::nonEmptyString();
        }
    }
}
