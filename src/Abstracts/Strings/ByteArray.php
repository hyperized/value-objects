<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class ByteArray implements \Hyperized\ValueObjects\Interfaces\Strings\ByteArray
{
    protected string $value;

    public function getValue(): string
    {
        return $this->value;
    }

    final protected function __construct(string $value)
    {
        static::validate($value);
        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new static($value);
    }

    protected static function validate(string $value): void
    {
        if ('' === $value) {
            throw InvalidArgumentException::emptyString();
        }
    }
}
