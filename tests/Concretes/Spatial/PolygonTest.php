<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Spatial;

use Hyperized\ValueObjects\Concretes\Spatial\Coordinate;
use Hyperized\ValueObjects\Concretes\Spatial\Polygon;
use Hyperized\ValueObjects\Exceptions\SpatialException;
use PHPUnit\Framework\TestCase;

class PolygonTest extends TestCase {
	public function testFromCoordinates(): void {
		$points = [
			Coordinate::fromLatitudeAndLongitude( 0.0, 0.0 ),
			Coordinate::fromLatitudeAndLongitude( 1.0, 0.0 ),
			Coordinate::fromLatitudeAndLongitude( 1.0, 1.0 ),
		];
		$polygon = Polygon::fromCoordinates( $points );

		self::assertCount( 3, $polygon->getPoints() );
		self::assertSame( 3, $polygon->count() );
	}

	public function testGetPoints(): void {
		$points = [
			Coordinate::fromLatitudeAndLongitude( 10.0, 20.0 ),
			Coordinate::fromLatitudeAndLongitude( 30.0, 40.0 ),
			Coordinate::fromLatitudeAndLongitude( 50.0, 60.0 ),
		];
		$polygon = Polygon::fromCoordinates( $points );

		self::assertSame( 10.0, $polygon->getPoints()[0]->getLatitude() );
		self::assertSame( 60.0, $polygon->getPoints()[2]->getLongitude() );
	}

	public function testTooFewPoints(): void {
		$this->expectException( SpatialException::class );
		Polygon::fromCoordinates( [
			Coordinate::fromLatitudeAndLongitude( 0.0, 0.0 ),
			Coordinate::fromLatitudeAndLongitude( 1.0, 0.0 ),
		] );
	}

	public function testEmptyPoints(): void {
		$this->expectException( SpatialException::class );
		Polygon::fromCoordinates( [] );
	}

	public function testFourPoints(): void {
		$points = [
			Coordinate::fromLatitudeAndLongitude( 0.0, 0.0 ),
			Coordinate::fromLatitudeAndLongitude( 1.0, 0.0 ),
			Coordinate::fromLatitudeAndLongitude( 1.0, 1.0 ),
			Coordinate::fromLatitudeAndLongitude( 0.0, 1.0 ),
		];
		$polygon = Polygon::fromCoordinates( $points );
		self::assertSame( 4, $polygon->count() );
	}
}
