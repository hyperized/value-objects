<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Spatial;

use Hyperized\ValueObjects\Concretes\Spatial\GeoHash;
use Hyperized\ValueObjects\Exceptions\SpatialException;
use PHPUnit\Framework\TestCase;

class GeoHashTest extends TestCase {
	public function testFromString(): void {
		$gh = GeoHash::fromString( 'u4pruydqqvj' );
		self::assertSame( 'u4pruydqqvj', $gh->getValue() );
	}

	public function testPrecision(): void {
		self::assertSame( 5, GeoHash::fromString( 'u4pru' )->getPrecision() );
		self::assertSame( 1, GeoHash::fromString( 'u' )->getPrecision() );
		self::assertSame( 12, GeoHash::fromString( 'u4pruydqqvjw' )->getPrecision() );
	}

	public function testNormalizesToLowercase(): void {
		$gh = GeoHash::fromString( 'U4PRUYDQQVJ' );
		self::assertSame( 'u4pruydqqvj', $gh->getValue() );
	}

	public function testInvalidCharacters(): void {
		$this->expectException( SpatialException::class );
		GeoHash::fromString( 'invalid!' );
	}

	public function testEmptyString(): void {
		$this->expectException( SpatialException::class );
		GeoHash::fromString( '' );
	}

	public function testTooLong(): void {
		$this->expectException( SpatialException::class );
		GeoHash::fromString( 'u4pruydqqvjwx' );
	}

	public function testInvalidBase32Chars(): void {
		$this->expectException( SpatialException::class );
		GeoHash::fromString( 'abcai' );
	}
}
