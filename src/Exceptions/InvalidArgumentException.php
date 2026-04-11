<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Exceptions;

class InvalidArgumentException extends \InvalidArgumentException {
	public static function notNumericString( string $value ): InvalidArgumentException {
		return new self( "String is not a valid numeric value: '$value'" );
	}
}
