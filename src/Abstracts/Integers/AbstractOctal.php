<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Contracts\Integers\OctalIntegerInterface;
use Hyperized\ValueObjects\Exceptions\IntegerException;

abstract readonly class AbstractOctal extends AbstractInteger implements OctalIntegerInterface {
	protected const string PATTERN = '/0[0-7]+(_[0-7]+)*/';

	public static function fromOctal( int $value ): self {
		static::validateOctal( $value );

		return new static( $value );
	}

	protected static function validateOctal( int $value ): void {
		if ( ! static::canConvertAndBack( $value ) ) {
			throw IntegerException::notAnOctal();
		}
	}

	public static function canConvertAndBack( int $value ): bool {
		$string = (string) $value;

		if ( static::containsInvalidOctalNumbers( $value ) ) {
			return false;
		}

		$octal = octdec( $string );

		return (int) decoct( (int) $octal ) === $value;
	}

	#[\Override]
	public static function fromInteger( int $value ): OctalIntegerInterface {
		// PHP casts $value to octal in integer when it detects base 8.
		static::validateOctalInteger( $value );

		return new static( $value );
	}

	protected static function validateOctalInteger( int $value ): void {
		if ( static::containsInvalidOctalNumbers( $value ) || ! static::canConvertAndBack( $value ) ) {
			throw IntegerException::notAnOctal();
		}
	}

	protected static function containsInvalidOctalNumbers( int $value ): bool {
		return (bool) preg_match( '/[89]/', (string) $value );
	}

	#[\Override]
	public static function fromString( string $value ): self {
		static::validateOctalString( $value );

		return new static( intval( $value, 8 ) );
	}

	protected static function validateOctalString( string $value ): void {
		if ( ! static::isOctalString( $value ) ) {
			throw IntegerException::notAnOctal();
		}
	}

	protected static function isOctalString( string $value ): bool {
		return (bool) preg_match( static::PATTERN, $value );
	}

	#[\Override]
	public function getValue(): int {
		return $this->value;
	}

	#[\Override]
	public function asDecimal(): int {
		return (int) decoct( $this->value );
	}

	#[\Override]
	public function asDecimalString(): string {
		return '0' . decoct( $this->value );
	}
}
