<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Spatial;

use Hyperized\ValueObjects\Contracts\Spatial\CoordinateInterface;
use Hyperized\ValueObjects\Contracts\Spatial\PolygonInterface;
use Hyperized\ValueObjects\Exceptions\SpatialException;

abstract readonly class AbstractPolygon implements PolygonInterface {
	/** @var array<CoordinateInterface> */
	protected array $points;

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
		if ( count( $points ) < 3 ) {
			throw SpatialException::insufficientPolygonPoints( count( $points ) );
		}
	}

	/**
	 * @param array<CoordinateInterface> $points
	 */
	#[\Override]
	public static function fromCoordinates( array $points ): PolygonInterface {
		return new static( $points );
	}

	/**
	 * @return array<CoordinateInterface>
	 */
	#[\Override]
	public function getPoints(): array {
		return $this->points;
	}

	#[\Override]
	public function count(): int {
		return count( $this->points );
	}
}
