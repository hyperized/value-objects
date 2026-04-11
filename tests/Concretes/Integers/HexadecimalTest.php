<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Integers;

use Hyperized\ValueObjects\Concretes\Integers\Hexadecimal;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class HexadecimalTest extends TestCase {
	public function testFromString(): void {
		self::assertSame( 255, Hexadecimal::fromString( 'ff' )->getValue() );
	}

	public function testFromStringWithPrefix(): void {
		self::assertSame( 255, Hexadecimal::fromString( '0xff' )->getValue() );
	}

	public function testFromInteger(): void {
		self::assertSame( 255, Hexadecimal::fromInteger( 255 )->getValue() );
	}

	public function testAsHexString(): void {
		self::assertSame( '0xff', Hexadecimal::fromInteger( 255 )->asHexString() );
	}

	public function testInvalidHexString(): void {
		$this->expectException( InvalidArgumentException::class );
		Hexadecimal::fromString( 'xyz' );
	}
}
