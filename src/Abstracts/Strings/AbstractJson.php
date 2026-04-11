<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\JsonInterface;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractJson implements JsonInterface {
	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		json_decode( $value );

		if ( json_last_error() !== JSON_ERROR_NONE ) {
			throw InvalidArgumentException::invalidJson( $value );
		}
	}

	public static function fromString( string $value ): JsonInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}

	public function decode(): mixed {
		return json_decode( $this->value, true );
	}
}
