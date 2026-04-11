<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\EmailInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract readonly class AbstractEmail implements EmailInterface {
	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( filter_var( $value, FILTER_VALIDATE_EMAIL ) === false ) {
			throw StringException::invalidEmail( $value );
		}
	}

	#[\Override]
	public static function fromString( string $value ): EmailInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): string {
		return $this->value;
	}

	#[\Override]
	public function getLocalPart(): string {
		return explode( '@', $this->value )[0];
	}

	#[\Override]
	public function getDomain(): string {
		return explode( '@', $this->value )[1];
	}
}
