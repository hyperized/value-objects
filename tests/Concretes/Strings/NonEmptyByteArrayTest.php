<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\EmptyByteArray;
use Hyperized\ValueObjects\Concretes\Strings\NonEmptyByteArray;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class NonEmptyByteArrayTest extends TestCase
{
    public function testNonEmptyString(): void
    {
        assertSame('hello', NonEmptyByteArray::fromString('hello')->getValue());
    }

    public function testFilledString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        NonEmptyByteArray::fromString('');
    }
}
