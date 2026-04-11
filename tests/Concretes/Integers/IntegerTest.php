<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Tests\Concretes\Integers;

use Hyperized\ValueObjects\Concretes\Integers\Integer;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use TypeError;
use function PHPUnit\Framework\assertSame;

class IntegerTest extends TestCase
{
    public function testFromString(): void
    {
        assertSame(12, Integer::fromString("012")->getValue());
    }

    public function testFromStringTypeError(): void
    {
        $this->expectException(TypeError::class);
        assertSame(12, Integer::fromString(12)->getValue());
    }

    public function testFromInteger(): void
    {
        assertSame(12, Integer::fromInteger(12)->getValue());
    }

    public function testFromIntegerTypeError(): void
    {
        $this->expectException(TypeError::class);
        assertSame(12, Integer::fromInteger("012")->getValue());
    }

    public function testFromStringNonNumeric(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Integer::fromString("abc");
    }
}
