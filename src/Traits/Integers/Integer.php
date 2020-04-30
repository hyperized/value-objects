<?php
declare(strict_types=1);

namespace Hyperized\ValueObjects\Traits\Integers;

trait Integer
{
    protected int $value;

    protected function __construct(int $value)
    {
        static::validate($value);
        $this->value = $value;
    }

    public static function fromInteger(int $value): self
    {
        return new static($value);
    }

    public static function fromString(string $value): self
    {
        return new static((int)$value);
    }

    public function getValue(): int
    {
        return $this->value;
    }

    protected static function validate(int $value): void
    {
    }
}
