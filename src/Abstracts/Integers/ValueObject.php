<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts;

use Hyperized\ValueObjects\Interfaces\Integers\ValueObject as ValueObjectInterface;
use Hyperized\ValueObjects\Traits\Integers\ValueObject as ValueObjectTrait;
use InvalidArgumentException;

class ValueObject implements ValueObjectInterface
{
    use ValueObjectTrait;

    protected static int $min;
    protected static int $max;

    public function __construct(int $value)
    {
        $this->value = $value;
        $this->validate();
    }

    protected function validate(): void
    {
        if ($this->value < self::$min) {
            throw new InvalidArgumentException(
                get_class($this) .
                ' cannot be lower than "' . self::$min . '", was provided with "' . $this->value . '"'
            );
        }

        if ($this->value > self::$max) {
            throw new InvalidArgumentException(
                get_class($this) .
                ' cannot be higher than "' . self::$max . '", was provided with "' . $this->value . '"'
            );
        }
    }
}