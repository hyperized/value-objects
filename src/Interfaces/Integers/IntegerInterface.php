<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Interfaces\Integers;

interface IntegerInterface
{
    public static function fromInteger(int $value): self;

    public static function fromString(string $value): self;
    
    public function getValue(): int;
}
