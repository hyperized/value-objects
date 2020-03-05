<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Interfaces\Integers;

interface Integer
{
    public static function fromInteger(int $value): self;

    public function getValue(): int;
}