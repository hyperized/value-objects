<?php


namespace Hyperized\ValueObjects\Abstracts\Strings;


use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

class AbstractNonEmptyByteArray extends AbstractByteArray
{
    protected static function validate(string $value): void
    {
        if ('' === $value) {
            throw InvalidArgumentException::emptyString();
        }
    }
}