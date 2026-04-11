<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Spatial;

use Hyperized\ValueObjects\Concretes\Spatial\Coordinate;
use Hyperized\ValueObjects\Concretes\Spatial\LineString;
use Hyperized\ValueObjects\Exceptions\SpatialException;
use PHPUnit\Framework\TestCase;

class LineStringTest extends TestCase {
	public function testFromCoordinates(): void {
		$points = [
			Coordinate::fromLatitudeAndLongitude( 0.0, 0.0 ),
			Coordinate::fromLatitudeAndLongitude( 1.0, 1.0 ),
		];
		$line = LineString::fromCoordinates( $points );

		self::assertCount( 2, $line->getPoints() );
		self::assertSame( 2, $line->count() );
	}

	public function testGetPoints(): void {
		$points = [
			Coordinate::fromLatitudeAndLongitude( 10.0, 20.0 ),
			Coordinate::fromLatitudeAndLongitude( 30.0, 40.0 ),
			Coordinate::fromLatitudeAndLongitude( 50.0, 60.0 ),
		];
		$line = LineString::fromCoordinates( $points );

		self::assertSame( 10.0, $line->getPoints()[0]->getLatitude() );
		self::assertSame( 3, $line->count() );
	}

	public function testTooFewPoints(): void {
		$this->expectException( SpatialException::class );
		LineString::fromCoordinates( [
			Coordinate::fromLatitudeAndLongitude( 0.0, 0.0 ),
		] );
	}

	public function testEmptyPoints(): void {
		$this->expectException( SpatialException::class );
		LineString::fromCoordinates( [] );
	}
}
