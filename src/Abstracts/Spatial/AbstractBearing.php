<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Spatial;

use Hyperized\ValueObjects\Contracts\Spatial\BearingInterface;
use Hyperized\ValueObjects\Enums\Spatial\CardinalDirection;
use Hyperized\ValueObjects\Exceptions\SpatialException;

abstract readonly class AbstractBearing implements BearingInterface {
	protected float $degrees;

	final protected function __construct( float $degrees ) {
		static::validate( $degrees );
		$this->degrees = $degrees;
	}

	protected static function validate( float $degrees ): void {
		if ( $degrees < 0.0 || $degrees > 360.0 ) {
			throw SpatialException::invalidBearing( $degrees );
		}
	}

	#[\Override]
	public static function fromDegrees( float $degrees ): BearingInterface {
		return new static( $degrees );
	}

	#[\Override]
	public function getValue(): float {
		return $this->degrees;
	}

	#[\Override]
	public function getCardinal(): CardinalDirection {
		return match ( true ) {
			$this->degrees >= 337.5 || $this->degrees < 22.5 => CardinalDirection::North,
			$this->degrees < 67.5 => CardinalDirection::NorthEast,
			$this->degrees < 112.5 => CardinalDirection::East,
			$this->degrees < 157.5 => CardinalDirection::SouthEast,
			$this->degrees < 202.5 => CardinalDirection::South,
			$this->degrees < 247.5 => CardinalDirection::SouthWest,
			$this->degrees < 292.5 => CardinalDirection::West,
			default => CardinalDirection::NorthWest,
		};
	}
}
