<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\RealNumbers;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractCoordinate implements CoordinateInterface {
	protected readonly float $latitude;
	protected readonly float $longitude;

	final protected function __construct( float $latitude, float $longitude ) {
		static::validate( $latitude, $longitude );
		$this->latitude = $latitude;
		$this->longitude = $longitude;
	}

	protected static function validate( float $latitude, float $longitude ): void {
		if ( $latitude < -90.0 || $latitude > 90.0 ) {
			throw InvalidArgumentException::invalidLatitude( $latitude );
		}

		if ( $longitude < -180.0 || $longitude > 180.0 ) {
			throw InvalidArgumentException::invalidLongitude( $longitude );
		}
	}

	public static function fromLatitudeAndLongitude( float $latitude, float $longitude ): CoordinateInterface {
		return new static( $latitude, $longitude );
	}

	public function getLatitude(): float {
		return $this->latitude;
	}

	public function getLongitude(): float {
		return $this->longitude;
	}
}
