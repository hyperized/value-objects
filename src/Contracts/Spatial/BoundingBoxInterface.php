<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Spatial;

interface BoundingBoxInterface {
	public static function fromCoordinates( CoordinateInterface $southwest, CoordinateInterface $northeast ): BoundingBoxInterface;

	public function getSouthwest(): CoordinateInterface;

	public function getNortheast(): CoordinateInterface;

	public function contains( CoordinateInterface $point ): bool;
}
