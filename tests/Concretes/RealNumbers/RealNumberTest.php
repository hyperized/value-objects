<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Tests\Concretes\RealNumbers;

use Hyperized\ValueObjects\Concretes\RealNumbers\RealNumber;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class RealNumberTest extends TestCase
{
    public function floatProvider(): array
    {
        return [
            [1.234],
            [1.2e3],
            [7E-10],
            [1_234.567]
        ];
    }

    public function stringProvider(): array
    {
        return [
            ["1.234", 1.234],
            ["1.2e3", 1.2e3],
            ["7E-10", 7E-10],
            // ["1_234.567", 1_234.567] // Should convert, however it results in 1.0 https://3v4l.org/7S2NO
        ];
    }

    public function integerProvider(): array
    {
        return [
            [1, 1],
            [50000, 50000]
        ];
    }

    /**
     * @dataProvider floatProvider
     * @param float $float
     */
    public function testFromFloat(float $float): void
    {
        assertSame($float, RealNumber::fromFloat($float)->getValue());
    }

    /**
     * @dataProvider stringProvider
     * @param string $string
     * @param float $float
     */
    public function testFromString(string $string, float $float): void
    {
        assertSame($float, RealNumber::fromString($string)->getValue());
    }

    /**
     * @dataProvider integerProvider
     * @param int $integer
     * @param float $float
     */
    public function testFromInteger(int $integer, float $float): void
    {
        assertSame($float, RealNumber::fromInteger($integer)->getValue());
    }
}
