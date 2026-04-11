<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\MacAddressInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract class AbstractMacAddress implements MacAddressInterface {
	protected static string $pattern = '/^([0-9a-f]{2}[:\-]){5}[0-9a-f]{2}$/i';

	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = strtolower( str_replace( '-', ':', $value ) );
	}

	protected static function validate( string $value ): void {
		if ( ! preg_match( static::$pattern, $value ) ) {
			throw StringException::invalidMacAddress( $value );
		}
	}

	public static function fromString( string $value ): MacAddressInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}
}
