<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\RealNumbers;

interface PercentageInterface {
	public static function fromFloat( float $value ): PercentageInterface;

	public static function fromInteger( int $value ): PercentageInterface;

	public static function fromString( string $value ): PercentageInterface;

	public function getValue(): float;

	public function asFraction(): float;
}
