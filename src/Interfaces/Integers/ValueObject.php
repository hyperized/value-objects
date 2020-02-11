<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Interfaces\Integers;

interface ValueObject
{
    public function __construct(int $value);

    public function getValue(): int;
}