<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\UuidInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract readonly class AbstractUuid implements UuidInterface {
	protected const string PATTERN = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';

	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = strtolower( $value );
	}

	protected static function validate( string $value ): void {
		if ( ! preg_match( static::PATTERN, $value ) ) {
			throw StringException::invalidUuid( $value );
		}
	}

	#[\Override]
	public static function fromString( string $value ): UuidInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): string {
		return $this->value;
	}

	#[\Override]
	public function getVersion(): int {
		return (int) $this->value[14];
	}
}
