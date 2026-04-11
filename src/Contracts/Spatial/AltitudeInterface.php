<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Spatial;

interface AltitudeInterface {
	public static function fromMeters( float $meters ): AltitudeInterface;

	public static function fromFeet( float $feet ): AltitudeInterface;

	public function toMeters(): float;

	public function toFeet(): float;

	public function getValue(): float;

	public function getUnit(): string;
}
