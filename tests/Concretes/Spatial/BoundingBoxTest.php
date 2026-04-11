<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Spatial;

use Hyperized\ValueObjects\Concretes\Spatial\BoundingBox;
use Hyperized\ValueObjects\Concretes\Spatial\Coordinate;
use Hyperized\ValueObjects\Exceptions\SpatialException;
use PHPUnit\Framework\TestCase;

class BoundingBoxTest extends TestCase {
	public function testFromCoordinates(): void {
		$sw = Coordinate::fromLatitudeAndLongitude( 40.0, -74.0 );
		$ne = Coordinate::fromLatitudeAndLongitude( 41.0, -73.0 );
		$box = BoundingBox::fromCoordinates( $sw, $ne );

		self::assertSame( 40.0, $box->getSouthwest()->getLatitude() );
		self::assertSame( -74.0, $box->getSouthwest()->getLongitude() );
		self::assertSame( 41.0, $box->getNortheast()->getLatitude() );
		self::assertSame( -73.0, $box->getNortheast()->getLongitude() );
	}

	public function testContainsPointInside(): void {
		$sw = Coordinate::fromLatitudeAndLongitude( 40.0, -74.0 );
		$ne = Coordinate::fromLatitudeAndLongitude( 41.0, -73.0 );
		$box = BoundingBox::fromCoordinates( $sw, $ne );

		$point = Coordinate::fromLatitudeAndLongitude( 40.5, -73.5 );
		self::assertTrue( $box->contains( $point ) );
	}

	public function testContainsPointOutside(): void {
		$sw = Coordinate::fromLatitudeAndLongitude( 40.0, -74.0 );
		$ne = Coordinate::fromLatitudeAndLongitude( 41.0, -73.0 );
		$box = BoundingBox::fromCoordinates( $sw, $ne );

		$point = Coordinate::fromLatitudeAndLongitude( 42.0, -73.5 );
		self::assertFalse( $box->contains( $point ) );
	}

	public function testContainsPointOnBoundary(): void {
		$sw = Coordinate::fromLatitudeAndLongitude( 40.0, -74.0 );
		$ne = Coordinate::fromLatitudeAndLongitude( 41.0, -73.0 );
		$box = BoundingBox::fromCoordinates( $sw, $ne );

		$point = Coordinate::fromLatitudeAndLongitude( 40.0, -74.0 );
		self::assertTrue( $box->contains( $point ) );
	}

	public function testContainsPointOutsideLongitude(): void {
		$sw = Coordinate::fromLatitudeAndLongitude( 40.0, -74.0 );
		$ne = Coordinate::fromLatitudeAndLongitude( 41.0, -73.0 );
		$box = BoundingBox::fromCoordinates( $sw, $ne );

		$point = Coordinate::fromLatitudeAndLongitude( 40.5, -75.0 );
		self::assertFalse( $box->contains( $point ) );
	}

	public function testInvalidSwNorthOfNe(): void {
		$this->expectException( SpatialException::class );
		$sw = Coordinate::fromLatitudeAndLongitude( 42.0, -74.0 );
		$ne = Coordinate::fromLatitudeAndLongitude( 41.0, -73.0 );
		BoundingBox::fromCoordinates( $sw, $ne );
	}

	public function testContainsPointOnNortheastBoundary(): void {
		$sw = Coordinate::fromLatitudeAndLongitude( 40.0, -74.0 );
		$ne = Coordinate::fromLatitudeAndLongitude( 41.0, -73.0 );
		$box = BoundingBox::fromCoordinates( $sw, $ne );

		$point = Coordinate::fromLatitudeAndLongitude( 41.0, -73.0 );
		self::assertTrue( $box->contains( $point ) );
	}

	public function testDoesNotContainJustOutsideNortheast(): void {
		$sw = Coordinate::fromLatitudeAndLongitude( 40.0, -74.0 );
		$ne = Coordinate::fromLatitudeAndLongitude( 41.0, -73.0 );
		$box = BoundingBox::fromCoordinates( $sw, $ne );

		self::assertFalse( $box->contains( Coordinate::fromLatitudeAndLongitude( 41.1, -73.0 ) ) );
		self::assertFalse( $box->contains( Coordinate::fromLatitudeAndLongitude( 41.0, -72.9 ) ) );
	}

	public function testSameLatitudeAllowed(): void {
		$sw = Coordinate::fromLatitudeAndLongitude( 40.0, -74.0 );
		$ne = Coordinate::fromLatitudeAndLongitude( 40.0, -73.0 );
		$box = BoundingBox::fromCoordinates( $sw, $ne );
		self::assertSame( 40.0, $box->getSouthwest()->getLatitude() );
	}
}
