<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Spatial;

use Hyperized\ValueObjects\Contracts\Spatial\DistanceInterface;
use Hyperized\ValueObjects\Exceptions\SpatialException;

abstract readonly class AbstractDistance implements DistanceInterface {
	private const float METERS_PER_KILOMETER = 1000.0;
	private const float METERS_PER_MILE = 1609.344;
	private const float METERS_PER_FOOT = 0.3048;
	private const float METERS_PER_NAUTICAL_MILE = 1852.0;

	protected float $meters;

	final protected function __construct( float $meters ) {
		static::validate( $meters );
		$this->meters = $meters;
	}

	protected static function validate( float $meters ): void {
		if ( $meters < 0.0 ) {
			throw SpatialException::negativeDistance( $meters );
		}
	}

	#[\Override]
	public static function fromMeters( float $meters ): DistanceInterface {
		return new static( $meters );
	}

	#[\Override]
	public static function fromKilometers( float $kilometers ): DistanceInterface {
		return new static( $kilometers * self::METERS_PER_KILOMETER );
	}

	#[\Override]
	public static function fromMiles( float $miles ): DistanceInterface {
		return new static( $miles * self::METERS_PER_MILE );
	}

	public static function fromFeet( float $feet ): DistanceInterface {
		return new static( $feet * self::METERS_PER_FOOT );
	}

	public static function fromNauticalMiles( float $nauticalMiles ): DistanceInterface {
		return new static( $nauticalMiles * self::METERS_PER_NAUTICAL_MILE );
	}

	#[\Override]
	public function toMeters(): float {
		return $this->meters;
	}

	#[\Override]
	public function toKilometers(): float {
		return $this->meters / self::METERS_PER_KILOMETER;
	}

	#[\Override]
	public function toMiles(): float {
		return $this->meters / self::METERS_PER_MILE;
	}

	public function toFeet(): float {
		return $this->meters / self::METERS_PER_FOOT;
	}

	public function toNauticalMiles(): float {
		return $this->meters / self::METERS_PER_NAUTICAL_MILE;
	}

	#[\Override]
	public function getValue(): float {
		return $this->meters;
	}

	#[\Override]
	public function getUnit(): string {
		return 'meters';
	}
}
