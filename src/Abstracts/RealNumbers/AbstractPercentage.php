<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\RealNumbers;

use Hyperized\ValueObjects\Contracts\RealNumbers\PercentageInterface;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use Hyperized\ValueObjects\Exceptions\RealNumberException;

abstract class AbstractPercentage implements PercentageInterface {
	protected readonly float $value;

	final protected function __construct( float $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( float $value ): void {
		if ( $value < 0.0 || $value > 100.0 ) {
			throw RealNumberException::invalidPercentage( $value );
		}
	}

	public static function fromFloat( float $value ): PercentageInterface {
		return new static( $value );
	}

	public static function fromInteger( int $value ): PercentageInterface {
		return new static( (float) $value );
	}

	public static function fromString( string $value ): PercentageInterface {
		if ( ! is_numeric( $value ) ) {
			throw InvalidArgumentException::notNumericString( $value );
		}

		return new static( (float) $value );
	}

	public function getValue(): float {
		return $this->value;
	}

	public function asFraction(): float {
		return $this->value / 100.0;
	}
}
