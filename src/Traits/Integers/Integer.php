<?php

namespace Hyperized\ValueObjects\Traits\Integers;

trait Integer
{
    protected int $value;

    public function getValue(): int
    {
        return $this->value;
    }
}