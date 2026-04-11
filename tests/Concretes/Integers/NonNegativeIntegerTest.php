<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Integers;

use Hyperized\ValueObjects\Concretes\Integers\NonNegativeInteger;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NonNegativeIntegerTest extends TestCase {
	public function testFromInteger(): void {
		self::assertSame( 5, NonNegativeInteger::fromInteger( 5 )->getValue() );
	}

	public function testZero(): void {
		self::assertSame( 0, NonNegativeInteger::fromInteger( 0 )->getValue() );
	}

	public function testFromString(): void {
		self::assertSame( 42, NonNegativeInteger::fromString( '42' )->getValue() );
	}

	public function testNegativeInteger(): void {
		$this->expectException( InvalidArgumentException::class );
		NonNegativeInteger::fromInteger( -1 );
	}

	public function testNegativeFromString(): void {
		$this->expectException( InvalidArgumentException::class );
		NonNegativeInteger::fromString( '-5' );
	}
}
