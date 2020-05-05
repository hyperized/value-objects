<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Exception;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class Octal extends Integer
{
    protected static string $pattern = '/0[0-7]+(_[0-7]+)*/';

    public static function fromOctal(int $value): self
    {
        static::validateOctal($value);
        return new static($value);
    }

    protected static function validateOctal(int $value): void
    {
        if (!static::canConvertAndBack($value)) {
            throw InvalidArgumentException::notAnOctal();
        }
    }

    public static function canConvertAndBack(int $value): bool
    {
        try {
            $octal = octdec((string)$value);
        } catch (Exception $exception) {
            return false;
        }
        return (int)decoct((int)$octal) === $value;
    }

    public static function fromInteger(int $value): self
    {
        // PHP casts $value to octal in integer when it detects base 8.
        static::validateOctalInteger($value);
        return new static($value);
    }

    protected static function validateOctalInteger(int $value): void
    {
        if (static::containsInvalidOctalNumbers($value) || !static::canConvertAndBack($value)) {
            throw InvalidArgumentException::notAnOctal();
        }
    }

    protected static function containsInvalidOctalNumbers(int $value): bool
    {
        return in_array($value, [8, 9], true) ? true : false;
    }

    public static function fromString(string $value): self
    {
        static::validateOctalString($value);
        return new static(intval($value, 8));
    }

    protected static function validateOctalString(string $value): void
    {
        if (!static::isOctalString($value)) {
            throw InvalidArgumentException::notAnOctal();
        }
    }

    protected static function isOctalString(string $value): bool
    {
        return preg_match(static::$pattern, $value) ? true : false;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function asDecimal(): int
    {
        return (int)decoct($this->value);
    }

    public function asDecimalString(): string
    {
        return '0' . decoct($this->value);
    }
}
