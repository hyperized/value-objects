<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Interfaces\Integers;

interface IntegerInterface
{
    public static function fromInteger(int $value): IntegerInterface;

    public static function fromString(string $value): IntegerInterface;
    
    public function getValue(): int;
}
