<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Spatial;

use Hyperized\ValueObjects\Contracts\Spatial\BearingInterface;
use Hyperized\ValueObjects\Exceptions\SpatialException;

abstract class AbstractBearing implements BearingInterface {
	protected readonly float $degrees;

	final protected function __construct( float $degrees ) {
		static::validate( $degrees );
		$this->degrees = $degrees;
	}

	protected static function validate( float $degrees ): void {
		if ( $degrees < 0.0 || $degrees > 360.0 ) {
			throw SpatialException::invalidBearing( $degrees );
		}
	}

	public static function fromDegrees( float $degrees ): BearingInterface {
		return new static( $degrees );
	}

	public function getValue(): float {
		return $this->degrees;
	}

	public function getCardinal(): string {
		return match ( true ) {
			$this->degrees >= 337.5 || $this->degrees < 22.5 => 'N',
			$this->degrees < 67.5 => 'NE',
			$this->degrees < 112.5 => 'E',
			$this->degrees < 157.5 => 'SE',
			$this->degrees < 202.5 => 'S',
			$this->degrees < 247.5 => 'SW',
			$this->degrees < 292.5 => 'W',
			default => 'NW',
		};
	}
}
