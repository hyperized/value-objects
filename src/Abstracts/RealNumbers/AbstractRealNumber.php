<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\RealNumbers;

use Hyperized\ValueObjects\Contracts\RealNumbers\RealNumberInterface;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract readonly class AbstractRealNumber implements RealNumberInterface {
	protected float $value;

	final protected function __construct( float $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( float $value ): void {
		// No validation required beyond type
	}

	#[\Override]
	public static function fromFloat( float $value ): RealNumberInterface {
		return new static( $value );
	}

	#[\Override]
	public static function fromInteger( int $value ): RealNumberInterface {
		return new static( (float) $value );
	}

	#[\Override]
	public static function fromString( string $value ): RealNumberInterface {
		if ( ! is_numeric( $value ) ) {
			throw InvalidArgumentException::notNumericString( $value );
		}

		return new static( (float) $value );
	}

	#[\Override]
	public function getValue(): float {
		return $this->value;
	}
}