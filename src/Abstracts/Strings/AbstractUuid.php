<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractUuid implements UuidInterface {
	protected static string $pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';

	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = strtolower( $value );
	}

	protected static function validate( string $value ): void {
		if ( ! preg_match( static::$pattern, $value ) ) {
			throw InvalidArgumentException::invalidUuid( $value );
		}
	}

	public static function fromString( string $value ): UuidInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}

	public function getVersion(): int {
		return (int) $this->value[14];
	}
}
