<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Contracts\Integers\HexadecimalInterface;
use Hyperized\ValueObjects\Exceptions\IntegerException;

abstract readonly class AbstractHexadecimal implements HexadecimalInterface {
	protected const string PATTERN = '/^(0x)?[0-9a-f]+$/i';

	protected int $value;

	final protected function __construct( int $value ) {
		$this->value = $value;
	}

	#[\Override]
	public static function fromString( string $value ): HexadecimalInterface {
		if ( ! preg_match( static::PATTERN, $value ) ) {
			throw IntegerException::invalidHexadecimal( $value );
		}

		return new static( (int) hexdec( $value ) );
	}

	#[\Override]
	public static function fromInteger( int $value ): HexadecimalInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): int {
		return $this->value;
	}

	#[\Override]
	public function asHexString(): string {
		return '0x' . dechex( $this->value );
	}
}
