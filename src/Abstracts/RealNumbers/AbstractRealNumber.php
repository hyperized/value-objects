<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\RealNumbers;

use Hyperized\ValueObjects\Interfaces\RealNumbers\RealNumberInterface;

class AbstractRealNumber implements RealNumberInterface
{
    protected float $value;

    final protected function __construct(float $value)
    {
        static::validate($value);
        $this->value = $value;
    }

    protected static function validate(float $value): void
    {
        // No validation required beyond type
    }

    public static function fromFloat(float $value): RealNumberInterface
    {
        return new static($value);
    }

    public static function fromInteger(int $value): RealNumberInterface
    {
        return new static((float)$value);
    }

    public static function fromString(string $value): RealNumberInterface
    {
        return new static((float)$value);
    }

    public function getValue(): float
    {
        return $this->value;
    }
}