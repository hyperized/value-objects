<?php

namespace Hyperized\ValueObjects\Tests;


use Hyperized\ValueObjects\Abstracts\Integers\ValueObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IntegerValueObjectTest extends TestCase
{
    protected $anonymousClassFromAbstract;
    protected static int $value = 0777;

    public function setUp(): void
    {
        $this->anonymousClassFromAbstract = new class(self::$value) extends ValueObject {
            protected int $min = 100;
            protected int $max = 9999;

            public function returnThis(): self
            {
                return $this;
            }
        };
    }

    public function test__construct(): void
    {
        $this->assertInstanceOf(
            ValueObject::class,
            $this->anonymousClassFromAbstract->returnThis()
        );
    }

    public function test_incorrect_unset_max__construct(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class(self::$value) extends ValueObject {
            protected int $min = 1;
        };
    }

    public function test_incorrect_unset_min__construct(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class(self::$value) extends ValueObject {
            protected int $max = 1;
        };
    }

    public function test_incorrect_max__construct(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class(self::$value) extends ValueObject {
            protected int $min = 1;
            protected int $max = 10;
        };
    }

    public function test_incorrect_min__construct(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class(self::$value) extends ValueObject {
            protected int $min = 1000;
            protected int $max = 10000;
        };
    }

    public function testGetValue(): void
    {
        $this->assertSame(
            self::$value,
            $this->anonymousClassFromAbstract->getValue()
        );
    }
}
