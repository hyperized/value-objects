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

	public static function invalidEmail( string $value ): InvalidArgumentException {
		return new self( "Invalid email address: '$value'" );
	}

	public static function invalidUrl( string $value ): InvalidArgumentException {
		return new self( "Invalid URL: '$value'" );
	}

	public static function invalidUuid( string $value ): InvalidArgumentException {
		return new self( "Invalid UUID: '$value'" );
	}

	public static function invalidIpAddress( string $value ): InvalidArgumentException {
		return new self( "Invalid IP address: '$value'" );
	}

	public static function invalidPercentage( float $value ): InvalidArgumentException {
		return new self( "Percentage out of range (given: $value, range: 0-100)" );
	}

	public static function nonNegativeInteger(): InvalidArgumentException {
		return new self( 'Integer must be non-negative (0 or larger)' );
	}

	public static function invalidHexadecimal( string $value ): InvalidArgumentException {
		return new self( "Invalid hexadecimal value: '$value'" );
	}

	public static function invalidJson( string $value ): InvalidArgumentException {
		return new self( "Invalid JSON: '$value'" );
	}

	/**
	 * @param array<string> $allowedValues
	 */
	public static function valueNotAllowed( string $value, array $allowedValues ): InvalidArgumentException {
		return new self( "Value '$value' is not allowed (allowed: " . implode( ', ', $allowedValues ) . ')' );
	}

	public static function invalidLatitude( float $value ): InvalidArgumentException {
		return new self( "Latitude out of range (given: $value, range: -90 to 90)" );
	}

	public static function invalidLongitude( float $value ): InvalidArgumentException {
		return new self( "Longitude out of range (given: $value, range: -180 to 180)" );
	}

	public static function invalidPort( int $value ): InvalidArgumentException {
		return new self( "Port out of range (given: $value, range: 1-65535)" );
	}

	public static function invalidMacAddress( string $value ): InvalidArgumentException {
		return new self( "Invalid MAC address: '$value'" );
	}

	public static function invalidRegex( string $value ): InvalidArgumentException {
		return new self( "Invalid regular expression: '$value'" );
	}

	public static function invalidSemVer( string $value ): InvalidArgumentException {
		return new self( "Invalid semantic version: '$value'" );
	}

	public static function invalidHostname( string $value ): InvalidArgumentException {
		return new self( "Invalid hostname: '$value'" );
	}

	public static function invalidDateString( string $value ): InvalidArgumentException {
		return new self( "Invalid date string: '$value'" );
	}

	public static function invalidUri( string $value ): InvalidArgumentException {
		return new self( "Invalid URI: '$value'" );
	}
}
