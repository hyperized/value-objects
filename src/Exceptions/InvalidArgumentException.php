<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Exceptions;

class InvalidArgumentException extends \InvalidArgumentException {
	public static function negativeInteger(): InvalidArgumentException {
		return new self( 'Integer must be positive (larger than 0)' );
	}

	public static function positiveInteger(): InvalidArgumentException {
		return new self( 'Integer must be negative (smaller than 0)' );
	}

	public static function notAnOctal(): InvalidArgumentException {
		return new self( 'Integer is not an octal value' );
	}

	public static function outOfRange( int $value, int $minimum, int $maximum ): InvalidArgumentException {
		return new self( "Integer out of range (given: $value, range: $minimum-$maximum)" );
	}

	public static function emptyString(): InvalidArgumentException {
		return new self( 'Byte array cannot be empty' );
	}

	public static function nonEmptyString(): InvalidArgumentException {
		return new self( 'Byte array is not empty' );
	}

	public static function notACommaSeparatedString(): InvalidArgumentException {
		return new self( 'String is not comma separated' );
	}

	public static function notNumericString( string $value ): InvalidArgumentException {
		return new self( "String is not a valid numeric value: '$value'" );
	}
}
