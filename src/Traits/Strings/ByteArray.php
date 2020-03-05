<?php

namespace Hyperized\ValueObjects\Traits\Strings;

trait ByteArray
{
    protected string $value;

    public function getValue(): string
    {
        return $this->value;
    }
}