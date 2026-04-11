<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\RegexInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract readonly class AbstractRegex implements RegexInterface {
	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( @preg_match( $value, '' ) === false ) {
			throw StringException::invalidRegex( $value );
		}
	}

	#[\Override]
	public static function fromString( string $value ): RegexInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): string {
		return $this->value;
	}

	#[\Override]
	public function matches( string $subject ): bool {
		return (bool) preg_match( $this->value, $subject );
	}
}
