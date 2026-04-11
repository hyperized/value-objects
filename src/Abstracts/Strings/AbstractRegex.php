<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\RegexInterface;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractRegex implements RegexInterface {
	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( @preg_match( $value, '' ) === false ) {
			throw InvalidArgumentException::invalidRegex( $value );
		}
	}

	public static function fromString( string $value ): RegexInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}

	public function matches( string $subject ): bool {
		return (bool) preg_match( $this->value, $subject );
	}
}
