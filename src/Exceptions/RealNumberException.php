<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Exceptions;

class RealNumberException extends InvalidArgumentException {
	public static function invalidPercentage( float $value ): RealNumberException {
		return new self( "Percentage out of range (given: $value, range: 0-100)" );
	}
}
