<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Lists;

use Hyperized\ValueObjects\Concretes\Lists\Inventory;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class InventoryTest extends TestCase {
	public function testFromCommaSeparatedString(): void {
		self::assertSame( [ 'one', 'two' ], Inventory::fromCommaSeparatedString( 'one,two' )->getValue() );
	}

	public function testFromCommaSeparatedStringError(): void {
		$this->expectException( InvalidArgumentException::class );
		self::assertSame( [ 'one', 'two' ], Inventory::fromCommaSeparatedString( 'one-two' )->getValue() );
	}

	public function testStringContains(): void {
		self::assertTrue( Inventory::fromCommaSeparatedString( 'one,two' )->contains( 'one' ) );
	}

	public function testStringDoesntContain(): void {
		self::assertFalse( Inventory::fromCommaSeparatedString( 'one,two' )->contains( 'hello' )
		);
	}

	public function testYesNo(): void {
		self::assertFalse( Inventory::fromCommaSeparatedString( 'one,two' )->contains( 'hello' )
		);
	}
}
