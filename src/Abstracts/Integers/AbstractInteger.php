<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Contracts\Integers\IntegerInterface;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract readonly class AbstractInteger implements IntegerInterface {
	protected int $value;

	final protected function __construct( int $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( int $value ): void {
		// No validation required beyond type
	}

	#[\Override]
	public static function fromInteger( int $value ): IntegerInterface {
		return new static( $value );
	}

	#[\Override]
	public static function fromString( string $value ): IntegerInterface {
		if ( ! is_numeric( $value ) ) {
			throw InvalidArgumentException::notNumericString( $value );
		}

		return new static( (int) $value );
	}

	#[\Override]
	public function getValue(): int {
		return $this->value;
	}
}
