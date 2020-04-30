<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Tests\Concretes\Integers;

use Hyperized\ValueObjects\Concretes\Integers\NegativeInteger;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class NegativeIntegerTest extends TestCase
{
    public function testFromString(): void
    {
        assertSame(-1, NegativeInteger::fromString('-1')->getValue());
    }

    public function testFromStringPositive(): void
    {
        $this->expectException(InvalidArgumentException::class);
        NegativeInteger::fromInteger(1);
    }
}
