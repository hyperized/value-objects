<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\HostnameInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract class AbstractHostname implements HostnameInterface {
	protected static string $pattern = '/^(?!-)[a-z0-9-]{1,63}(?<!-)(\.[a-z0-9-]{1,63})*$/i';

	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = strtolower( $value );
	}

	protected static function validate( string $value ): void {
		if ( strlen( $value ) > 253 ) {
			throw StringException::invalidHostname( $value );
		}

		if ( ! preg_match( static::$pattern, $value ) ) {
			throw StringException::invalidHostname( $value );
		}
	}

	public static function fromString( string $value ): HostnameInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}
}
