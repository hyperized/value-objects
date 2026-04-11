<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Exceptions;

class IntegerException extends InvalidArgumentException {
	public static function negativeInteger(): IntegerException {
		return new self( 'Integer must be positive (larger than 0)' );
	}

	public static function positiveInteger(): IntegerException {
		return new self( 'Integer must be negative (smaller than 0)' );
	}

	public static function notAnOctal(): IntegerException {
		return new self( 'Integer is not an octal value' );
	}

	public static function outOfRange( int $value, int $minimum, int $maximum ): IntegerException {
		return new self( "Integer out of range (given: $value, range: $minimum-$maximum)" );
	}

	public static function nonNegativeInteger(): IntegerException {
		return new self( 'Integer must be non-negative (0 or larger)' );
	}

	public static function invalidHexadecimal( string $value ): IntegerException {
		return new self( "Invalid hexadecimal value: '$value'" );
	}

	public static function invalidPort( int $value ): IntegerException {
		return new self( "Port out of range (given: $value, range: 1-65535)" );
	}
}
