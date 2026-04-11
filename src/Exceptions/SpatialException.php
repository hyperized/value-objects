<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Exceptions;

class SpatialException extends InvalidArgumentException {
	public static function invalidLatitude( float $value ): SpatialException {
		return new self( "Latitude out of range (given: $value, range: -90 to 90)" );
	}

	public static function invalidLongitude( float $value ): SpatialException {
		return new self( "Longitude out of range (given: $value, range: -180 to 180)" );
	}
}
