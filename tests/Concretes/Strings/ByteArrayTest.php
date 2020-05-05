<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Integers\Integer;
use Hyperized\ValueObjects\Concretes\Strings\ByteArray;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use TypeError;
use function PHPUnit\Framework\assertSame;

class ByteArrayTest extends TestCase
{
    public function testFromString(): void
    {
        assertSame('hello', ByteArray::fromString('hello')->getValue());
    }

    public function testEmptySTring(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ByteArray::fromString('');
    }
}