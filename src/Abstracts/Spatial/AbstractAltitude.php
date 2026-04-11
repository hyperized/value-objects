<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Spatial;

use Hyperized\ValueObjects\Contracts\Spatial\AltitudeInterface;

abstract class AbstractAltitude implements AltitudeInterface {
	private const float METERS_PER_FOOT = 0.3048;

	protected readonly float $meters;

	final protected function __construct( float $meters ) {
		static::validate( $meters );
		$this->meters = $meters;
	}

	protected static function validate( float $meters ): void {
		// No validation beyond type — altitudes can be negative (below sea level)
	}

	public static function fromMeters( float $meters ): AltitudeInterface {
		return new static( $meters );
	}

	public static function fromFeet( float $feet ): AltitudeInterface {
		return new static( $feet * self::METERS_PER_FOOT );
	}

	public function toMeters(): float {
		return $this->meters;
	}

	public function toFeet(): float {
		return $this->meters / self::METERS_PER_FOOT;
	}

	public function getValue(): float {
		return $this->meters;
	}

	public function getUnit(): string {
		return 'meters';
	}
}
