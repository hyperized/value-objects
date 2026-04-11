<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Spatial;

interface DistanceInterface {
	public static function fromMeters( float $meters ): DistanceInterface;

	public static function fromKilometers( float $kilometers ): DistanceInterface;

	public static function fromMiles( float $miles ): DistanceInterface;

	public function toMeters(): float;

	public function toKilometers(): float;

	public function toMiles(): float;

	public function getValue(): float;

	public function getUnit(): string;
}
