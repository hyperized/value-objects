<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Spatial;

use Hyperized\ValueObjects\Concretes\Spatial\Coordinate;
use Hyperized\ValueObjects\Exceptions\SpatialException;
use PHPUnit\Framework\TestCase;

class CoordinateTest extends TestCase {
	public function testFromLatitudeAndLongitude(): void {
		$coord = Coordinate::fromLatitudeAndLongitude( 52.3676, 4.9041 );
		self::assertSame( 52.3676, $coord->getLatitude() );
		self::assertSame( 4.9041, $coord->getLongitude() );
	}

	public function testBoundaryValues(): void {
		$coord = Coordinate::fromLatitudeAndLongitude( 90.0, 180.0 );
		self::assertSame( 90.0, $coord->getLatitude() );
		self::assertSame( 180.0, $coord->getLongitude() );
	}

	public function testNegativeBoundary(): void {
		$coord = Coordinate::fromLatitudeAndLongitude( -90.0, -180.0 );
		self::assertSame( -90.0, $coord->getLatitude() );
		self::assertSame( -180.0, $coord->getLongitude() );
	}

	public function testInvalidLatitude(): void {
		$this->expectException( SpatialException::class );
		Coordinate::fromLatitudeAndLongitude( 91.0, 0.0 );
	}

	public function testInvalidLongitude(): void {
		$this->expectException( SpatialException::class );
		Coordinate::fromLatitudeAndLongitude( 0.0, 181.0 );
	}
}
