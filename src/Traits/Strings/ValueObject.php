<?php

namespace Hyperized\ValueObjects\Traits\Strings;

trait ValueObject
{
    protected string $value;

    public function getValue(): string
    {
        return $this->value;
    }
}