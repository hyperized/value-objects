<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Interfaces\Strings\ValueObject as ValueObjectInterface;
use Hyperized\ValueObjects\Traits\Strings\ValueObject as ValueObjectTrait;
use InvalidArgumentException;

class ValueObject implements ValueObjectInterface
{
    use ValueObjectTrait;

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