<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Interfaces\Integers;

interface Integer
{
    public static function fromInteger(int $value);
    public static function fromString(string $value);
    public function getValue(): int;
}
