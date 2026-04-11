<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Spatial;

interface PolygonInterface {
	/**
	 * @param array<CoordinateInterface> $points
	 */
	public static function fromCoordinates( array $points ): PolygonInterface;

	/**
	 * @return array<CoordinateInterface>
	 */
	public function getPoints(): array;

	public function count(): int;
}
