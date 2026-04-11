<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Spatial;

use Hyperized\ValueObjects\Contracts\Spatial\CoordinateInterface;
use Hyperized\ValueObjects\Contracts\Spatial\LineStringInterface;
use Hyperized\ValueObjects\Exceptions\SpatialException;

abstract class AbstractLineString implements LineStringInterface {
	/** @var array<CoordinateInterface> */
	protected readonly array $points;

	/**
	 * @param array<CoordinateInterface> $points
	 */
	final protected function __construct( array $points ) {
		static::validate( $points );
		$this->points = $points;
	}

	/**
	 * @param array<CoordinateInterface> $points
	 */
	protected static function validate( array $points ): void {
		if ( count( $points ) < 2 ) {
			throw SpatialException::insufficientLineStringPoints( count( $points ) );
		}
	}

	/**
	 * @param array<CoordinateInterface> $points
	 */
	public static function fromCoordinates( array $points ): LineStringInterface {
		return new static( $points );
	}

	/**
	 * @return array<CoordinateInterface>
	 */
	public function getPoints(): array {
		return $this->points;
	}

	public function count(): int {
		return count( $this->points );
	}
}
