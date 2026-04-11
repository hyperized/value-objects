<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Exceptions;

class StringException extends InvalidArgumentException {
	public static function emptyString(): StringException {
		return new self( 'Byte array cannot be empty' );
	}

	public static function nonEmptyString(): StringException {
		return new self( 'Byte array is not empty' );
	}

	public static function invalidEmail( string $value ): StringException {
		return new self( "Invalid email address: '$value'" );
	}

	public static function invalidUrl( string $value ): StringException {
		return new self( "Invalid URL: '$value'" );
	}

	public static function invalidUuid( string $value ): StringException {
		return new self( "Invalid UUID: '$value'" );
	}

	public static function invalidIpAddress( string $value ): StringException {
		return new self( "Invalid IP address: '$value'" );
	}

	public static function invalidJson( string $value ): StringException {
		return new self( "Invalid JSON: '$value'" );
	}

	public static function invalidMacAddress( string $value ): StringException {
		return new self( "Invalid MAC address: '$value'" );
	}

	public static function invalidRegex( string $value ): StringException {
		return new self( "Invalid regular expression: '$value'" );
	}

	public static function invalidSemVer( string $value ): StringException {
		return new self( "Invalid semantic version: '$value'" );
	}

	public static function invalidHostname( string $value ): StringException {
		return new self( "Invalid hostname: '$value'" );
	}

	public static function invalidDateString( string $value ): StringException {
		return new self( "Invalid date string: '$value'" );
	}

	public static function invalidUri( string $value ): StringException {
		return new self( "Invalid URI: '$value'" );
	}
}
