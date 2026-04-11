<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\IpAddress;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IpAddressTest extends TestCase {
	public function testFromStringIPv4(): void {
		$ip = IpAddress::fromString( '192.168.1.1' );
		self::assertSame( '192.168.1.1', $ip->getValue() );
	}

	public function testFromStringIPv6(): void {
		$ip = IpAddress::fromString( '::1' );
		self::assertSame( '::1', $ip->getValue() );
	}

	public function testIsIPv4(): void {
		$ip = IpAddress::fromString( '10.0.0.1' );
		self::assertTrue( $ip->isIPv4() );
		self::assertFalse( $ip->isIPv6() );
	}

	public function testIsIPv6(): void {
		$ip = IpAddress::fromString( '2001:0db8:85a3:0000:0000:8a2e:0370:7334' );
		self::assertFalse( $ip->isIPv4() );
		self::assertTrue( $ip->isIPv6() );
	}

	public function testInvalidIpAddress(): void {
		$this->expectException( InvalidArgumentException::class );
		IpAddress::fromString( '999.999.999.999' );
	}

	public function testInvalidString(): void {
		$this->expectException( InvalidArgumentException::class );
		IpAddress::fromString( 'not-an-ip' );
	}
}
