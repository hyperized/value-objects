<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\EmptyByteArray;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class EmptyByteArrayTest extends TestCase
{
    public function testFromString(): void
    {
        assertSame('', EmptyByteArray::fromString('')->getValue());
    }

    public function testFilledString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        EmptyByteArray::fromString('Something');
    }
}
