<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\ByteArrayInterface;

abstract readonly class AbstractByteArray implements ByteArrayInterface {
	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		// No validation required beyond type
	}

	#[\Override]
	public static function fromString( string $value ): ByteArrayInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): string {
		return $this->value;
	}
}
