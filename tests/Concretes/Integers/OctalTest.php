<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Tests\Concretes\Integers;

use Hyperized\ValueObjects\Concretes\Integers\Octal;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class OctalTest extends TestCase
{
    public function testCanConvert(): void
    {
        $octal = 511;
        $noOctal = 888;

        self::assertTrue(Octal::canConvertAndBack($octal));
        self::assertFalse(Octal::canConvertAndBack($noOctal));
    }

    public function testFromOctal(): void
    {
        assertSame(511, Octal::fromOctal(511)->getValue());
        assertSame(777, Octal::fromOctal(511)->asDecimal());
        assertSame('0777', Octal::fromOctal(511)->asDecimalString());
    }

    public function testFromString(): void
    {
        assertSame(511, Octal::fromString('0777')->getValue());
        assertSame(777, Octal::fromString('0777')->asDecimal());
        assertSame('0777', Octal::fromString('0777')->asDecimalString());
    }

    public function testFromInteger(): void
    {
        assertSame(777, Octal::fromInteger(777)->getValue()); // Input is base 8
        assertSame(511, Octal::fromInteger(0777)->getValue()); // Input is base 8 notated
        assertSame(777, Octal::fromInteger(0777)->asDecimal());
        assertSame('0777', Octal::fromInteger(0777)->asDecimalString());
    }

    public function testInvalidOctal(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Octal::fromOctal(0511);
    }

    public function testInvalidInteger(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Octal::fromInteger(888);
    }

    public function testInvalidIntegerContaining8(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Octal::fromInteger(18);
    }

    public function testCanConvertAndBackWithInvalidDigits(): void
    {
        self::assertFalse(Octal::canConvertAndBack(89));
    }

    public function testInvalidIntegerWithOnlyDigit9(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Octal::fromInteger(9);
    }

    public function testInvalidIntegerValidOctalButContains8(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Octal::fromInteger(800);
    }

    public function testInvalidString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Octal::fromString('777');
    }
}
