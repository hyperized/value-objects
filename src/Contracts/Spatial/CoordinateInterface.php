<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Spatial;

interface CoordinateInterface {
	public static function fromLatitudeAndLongitude( float $latitude, float $longitude ): CoordinateInterface;

	public function getLatitude(): float;

	public function getLongitude(): float;
}
