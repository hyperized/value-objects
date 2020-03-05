<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class Octal extends Integer
{
    protected function validate(): void
    {
        if (!static::isOctal($this->value)) {
            throw InvalidArgumentException::notAnOctal();
        }
    }

    protected static function isOctal(int $value): bool
    {
        return decoct(octdec($value)) === $value;
    }

    public function getValue(): int
    {
        return decoct($this->value);
    }
}