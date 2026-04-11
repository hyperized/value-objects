<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Spatial;

interface BearingInterface {
	public static function fromDegrees( float $degrees ): BearingInterface;

	public function getValue(): float;

	public function getCardinal(): string;
}
