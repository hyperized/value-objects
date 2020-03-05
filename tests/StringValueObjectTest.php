<?php

namespace Hyperized\ValueObjects\Tests;

use Hyperized\ValueObjects\Abstracts\Strings\String;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class StringValueObjectTest extends TestCase
{
    protected $anonymousClassFromAbstract;
    protected static string $value = 'Hello World!';

    public function setUp(): void
    {
        $this->anonymousClassFromAbstract = new class(self::$value) extends String {
            public function returnThis(): self
            {
                return $this;
            }
        };
    }

    public function test__construct(): void
    {
        $this->assertInstanceOf(
            String::class,
            $this->anonymousClassFromAbstract->returnThis()
        );
    }

    public function test_incorrect__construct(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class('') extends String {
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
