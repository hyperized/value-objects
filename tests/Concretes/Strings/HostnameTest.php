<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\Hostname;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class HostnameTest extends TestCase {
	public function testFromString(): void {
		$hostname = Hostname::fromString( 'example.com' );
		self::assertSame( 'example.com', $hostname->getValue() );
	}

	public function testNormalizesToLowercase(): void {
		self::assertSame( 'example.com', Hostname::fromString( 'Example.COM' )->getValue() );
	}

	public function testSubdomain(): void {
		self::assertSame( 'sub.example.com', Hostname::fromString( 'sub.example.com' )->getValue() );
	}

	public function testSingleLabel(): void {
		self::assertSame( 'localhost', Hostname::fromString( 'localhost' )->getValue() );
	}

	public function testInvalidHostnameStartsWithDash(): void {
		$this->expectException( InvalidArgumentException::class );
		Hostname::fromString( '-invalid.com' );
	}

	public function testInvalidHostnameSpecialChars(): void {
		$this->expectException( InvalidArgumentException::class );
		Hostname::fromString( 'invalid host!.com' );
	}

	public function testEmptyHostname(): void {
		$this->expectException( InvalidArgumentException::class );
		Hostname::fromString( '' );
	}

	public function testExactly253CharsIsValid(): void {
		$hostname = str_repeat( 'a', 63 ) . '.' . str_repeat( 'b', 63 ) . '.' . str_repeat( 'c', 63 ) . '.' . str_repeat( 'd', 61 );
		self::assertSame( strtolower( $hostname ), Hostname::fromString( $hostname )->getValue() );
	}

	public function testTooLongHostname(): void {
		$this->expectException( InvalidArgumentException::class );
		Hostname::fromString( str_repeat( 'a', 63 ) . '.' . str_repeat( 'b', 63 ) . '.' . str_repeat( 'c', 63 ) . '.' . str_repeat( 'd', 62 ) );
	}
}
