<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Interfaces\Integers\ValueObject as ValueObjectInterface;
use Hyperized\ValueObjects\Traits\Integers\ValueObject as ValueObjectTrait;
use InvalidArgumentException;


class ValueObject implements ValueObjectInterface
{
    use ValueObjectTrait;

    protected int $min;
    protected int $max;

    public function __construct(int $value)
    {
        $minIsSet = isset($this->min);
        $maxIsSet = isset($this->max);

        if (!$minIsSet) {
            throw new InvalidArgumentException(get_class($this) .
                ' has not set $min value');
        }

        if (!$maxIsSet) {
            throw new InvalidArgumentException(get_class($this) .
                ' has not set $max value');
        }

        $this->value = $value;
        $this->validate();
    }

    protected function validate(): void
    {
        if ($this->value < $this->min) {
            throw new InvalidArgumentException(
                get_class($this) .
                ' cannot be lower than "' . $this->min . '", was provided with "' . $this->value . '"'
            );
        }

        if ($this->value > $this->max) {
            throw new InvalidArgumentException(
                get_class($this) .
                ' cannot be higher than "' . $this->max . '", was provided with "' . $this->value . '"'
            );
        }
    }
}