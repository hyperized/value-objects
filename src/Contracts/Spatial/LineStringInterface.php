<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Spatial;

interface LineStringInterface {
	/**
	 * @param array<CoordinateInterface> $points
	 */
	public static function fromCoordinates( array $points ): LineStringInterface;

	/**
	 * @return array<CoordinateInterface>
	 */
	public function getPoints(): array;

	public function count(): int;
}
