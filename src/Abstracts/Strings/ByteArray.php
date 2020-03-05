<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Strings;

use InvalidArgumentException;

abstract class ByteArray implements \Hyperized\ValueObjects\Interfaces\Strings\ByteArray
{
    use \Hyperized\ValueObjects\Traits\Strings\ByteArray;

    public function __construct(string $value)
    {
        $this->value = $value;
        $this->validate();
    }

    protected function validate(): void
    {
        if ('' === $this->value) {
            throw new InvalidArgumentException(get_class($this) . ' cannot be empty');
        }
    }
}