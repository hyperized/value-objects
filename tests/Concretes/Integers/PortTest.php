<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Integers;

use Hyperized\ValueObjects\Concretes\Integers\Port;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PortTest extends TestCase {
	public function testFromInteger(): void {
		self::assertSame( 8080, Port::fromInteger( 8080 )->getValue() );
	}

	public function testFromString(): void {
		self::assertSame( 443, Port::fromString( '443' )->getValue() );
	}

	public function testMinPort(): void {
		self::assertSame( 1, Port::fromInteger( 1 )->getValue() );
	}

	public function testMaxPort(): void {
		self::assertSame( 65535, Port::fromInteger( 65535 )->getValue() );
	}

	public function testZeroPort(): void {
		$this->expectException( InvalidArgumentException::class );
		Port::fromInteger( 0 );
	}

	public function testTooHighPort(): void {
		$this->expectException( InvalidArgumentException::class );
		Port::fromInteger( 65536 );
	}
}
