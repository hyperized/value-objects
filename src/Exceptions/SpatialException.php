<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Exceptions;

class SpatialException extends InvalidArgumentException {
	public static function invalidLatitude( float $value ): SpatialException {
		return new self( "Latitude out of range (given: $value, range: -90 to 90)" );
	}

	public static function invalidLongitude( float $value ): SpatialException {
		return new self( "Longitude out of range (given: $value, range: -180 to 180)" );
	}

	public static function invalidBoundingBox(): SpatialException {
		return new self( 'Southwest corner must be south and west of northeast corner' );
	}

	public static function negativeDistance( float $value ): SpatialException {
		return new self( "Distance must be non-negative (given: $value)" );
	}

	public static function invalidBearing( float $value ): SpatialException {
		return new self( "Bearing out of range (given: $value, range: 0 to 360)" );
	}

	public static function invalidGeoHash( string $value ): SpatialException {
		return new self( "Invalid geohash: '$value'" );
	}

	public static function insufficientPolygonPoints( int $count ): SpatialException {
		return new self( "Polygon requires at least 3 points (given: $count)" );
	}

	public static function insufficientLineStringPoints( int $count ): SpatialException {
		return new self( "LineString requires at least 2 points (given: $count)" );
	}
}
