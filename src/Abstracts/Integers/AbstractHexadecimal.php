<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Contracts\Integers\HexadecimalInterface;
use Hyperized\ValueObjects\Exceptions\IntegerException;

abstract class AbstractHexadecimal implements HexadecimalInterface {
	protected static string $pattern = '/^(0x)?[0-9a-f]+$/i';

	protected readonly int $value;

	final protected function __construct( int $value ) {
		$this->value = $value;
	}

	public static function fromString( string $value ): HexadecimalInterface {
		if ( ! preg_match( static::$pattern, $value ) ) {
			throw IntegerException::invalidHexadecimal( $value );
		}

		return new static( (int) hexdec( $value ) );
	}

	public static function fromInteger( int $value ): HexadecimalInterface {
		return new static( $value );
	}

	public function getValue(): int {
		return $this->value;
	}

	public function asHexString(): string {
		return '0x' . dechex( $this->value );
	}
}
