<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Interfaces\Strings;

interface ValueObject
{
    public function __construct(string $value);

    public function getValue(): string;
}