<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\MacAddress;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class MacAddressTest extends TestCase {
	public function testFromStringColon(): void {
		$mac = MacAddress::fromString( '00:1A:2B:3C:4D:5E' );
		self::assertSame( '00:1a:2b:3c:4d:5e', $mac->getValue() );
	}

	public function testFromStringDash(): void {
		$mac = MacAddress::fromString( '00-1A-2B-3C-4D-5E' );
		self::assertSame( '00:1a:2b:3c:4d:5e', $mac->getValue() );
	}

	public function testInvalidMacAddress(): void {
		$this->expectException( InvalidArgumentException::class );
		MacAddress::fromString( 'not-a-mac' );
	}

	public function testTooShortMacAddress(): void {
		$this->expectException( InvalidArgumentException::class );
		MacAddress::fromString( '00:1A:2B' );
	}
}
