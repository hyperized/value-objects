<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Interfaces\Strings;

interface ByteArray
{
    public static function fromString(string $value): self;
    public function getValue(): string;
}
