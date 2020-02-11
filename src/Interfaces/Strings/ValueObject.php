<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Strings\Interfaces;

interface ValueObject
{
    public function __construct(string $value);

    public function getValue(): string;
}