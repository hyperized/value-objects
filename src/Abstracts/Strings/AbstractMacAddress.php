<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\MacAddressInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract readonly class AbstractMacAddress implements MacAddressInterface {
	protected const string PATTERN = '/^([0-9a-f]{2}[:\-]){5}[0-9a-f]{2}$/i';

	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = strtolower( str_replace( '-', ':', $value ) );
	}

	protected static function validate( string $value ): void {
		if ( ! preg_match( static::PATTERN, $value ) ) {
			throw StringException::invalidMacAddress( $value );
		}
	}

	#[\Override]
	public static function fromString( string $value ): MacAddressInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): string {
		return $this->value;
	}
}
