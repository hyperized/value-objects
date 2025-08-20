<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

abstract class AbstractInteger implements IntegerInterface {
	protected int $value;

	final protected function __construct( int $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( int $value ): void {
		// No validation required beyond type
	}

	public static function fromInteger( int $value ): IntegerInterface {
		return new static( $value );
	}

	public static function fromString( string $value ): IntegerInterface {
		return new static( (int) $value );
	}

	public function getValue(): int {
		return $this->value;
	}
}
