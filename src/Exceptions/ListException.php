<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Exceptions;

class ListException extends InvalidArgumentException {
	public static function notACommaSeparatedString(): ListException {
		return new self( 'String is not comma separated' );
	}

	/**
	 * @param array<string> $allowedValues
	 */
	public static function valueNotAllowed( string $value, array $allowedValues ): ListException {
		return new self( "Value '$value' is not allowed (allowed: " . implode( ', ', $allowedValues ) . ')' );
	}
}
