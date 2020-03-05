<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Interfaces\Integers\Integer as IntegerInterface;
use Hyperized\ValueObjects\Traits\Integers\Integer as IntegerTrait;

abstract class Integer implements IntegerInterface
{
    use IntegerTrait;

    public static function fromInteger(int $value): self
    {
        print_r($value);
        echo "\n";
        print_r(octdec($value));

        return new static($value);
    }

    private function __construct(int $value)
    {
        $this->value = $value;
        $this->validate();
    }

    protected function validate(): void {}
}