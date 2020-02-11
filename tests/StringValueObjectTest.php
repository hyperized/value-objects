<?php

namespace Hyperized\ValueObjects\Tests;

use Hyperized\ValueObjects\Abstracts\Strings\ValueObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class StringValueObjectTest extends TestCase
{
    protected $anonymousClassFromAbstract;
    protected static string $value = 'Hello World!';

    public function setUp(): void
    {
        $this->anonymousClassFromAbstract = new class(self::$value) extends ValueObject {
            public function returnThis(): self
            {
                return $this;
            }
        };
    }

    public function test__construct()
    {
        $this->assertInstanceOf(
            ValueObject::class,
            $this->anonymousClassFromAbstract->returnThis()
        );
    }

    public function test_incorrect__construct()
    {
        $this->expectException(InvalidArgumentException::class);
        new class('') extends ValueObject {
        };
    }

    public function testGetValue()
    {
        $this->assertSame(
            self::$value,
            $this->anonymousClassFromAbstract->getValue()
        );
    }
}
