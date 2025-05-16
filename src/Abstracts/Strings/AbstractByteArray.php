<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Interfaces\Strings\ByteArrayInterface;

abstract class AbstractByteArray implements ByteArrayInterface {
	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		// No validation required beyond type
	}

	public static function fromString( string $value ): self {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}
}
