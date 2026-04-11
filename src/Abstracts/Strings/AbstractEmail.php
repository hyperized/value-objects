<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\EmailInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract class AbstractEmail implements EmailInterface {
	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( filter_var( $value, FILTER_VALIDATE_EMAIL ) === false ) {
			throw StringException::invalidEmail( $value );
		}
	}

	public static function fromString( string $value ): EmailInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}

	public function getLocalPart(): string {
		return explode( '@', $this->value )[0];
	}

	public function getDomain(): string {
		return explode( '@', $this->value )[1];
	}
}
