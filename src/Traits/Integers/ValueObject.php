<?php

namespace Hyperized\ValueObjects\Traits\Integers;

trait ValueObject
{
    protected int $value;

    public function getValue(): int
    {
        return $this->value;
    }
}