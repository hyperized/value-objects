<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Tests\Concretes\Integers;

use Hyperized\ValueObjects\Concretes\Integers\PositiveInteger;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class PositiveIntegerTest extends TestCase
{
    protected static int $expected = 1;
    protected static string $positive = '1';
    protected static int $negative = -1;

    public function testFromString(): void
    {
        assertSame(
            static::$expected,
            PositiveInteger
                ::fromString(static::$positive)
                ->getValue()
        );
    }

    public function testFromStringNegative(): void
    {
        $this->expectException(InvalidArgumentException::class);
        PositiveInteger::fromInteger(static::$negative);
    }
}
