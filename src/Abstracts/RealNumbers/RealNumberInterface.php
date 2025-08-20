<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\RealNumbers;

interface RealNumberInterface {
	public static function fromFloat( float $value ): RealNumberInterface;

	public static function fromInteger( int $value ): RealNumberInterface;

	public static function fromString( string $value ): RealNumberInterface;

	public function getValue(): float;
}
