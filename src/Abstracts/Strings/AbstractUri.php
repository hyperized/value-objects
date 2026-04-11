<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\UriInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract readonly class AbstractUri implements UriInterface {
	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( parse_url( $value ) === false ) {
			throw StringException::invalidUri( $value );
		}

		if ( parse_url( $value, PHP_URL_SCHEME ) === null ) {
			throw StringException::invalidUri( $value );
		}
	}

	#[\Override]
	public static function fromString( string $value ): UriInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): string {
		return $this->value;
	}

	#[\Override]
	public function getScheme(): string {
		return (string) parse_url( $this->value, PHP_URL_SCHEME );
	}

	#[\Override]
	public function getHost(): string {
		return (string) parse_url( $this->value, PHP_URL_HOST );
	}

	#[\Override]
	public function getPath(): string {
		return (string) parse_url( $this->value, PHP_URL_PATH );
	}

	#[\Override]
	public function getQuery(): string {
		return (string) parse_url( $this->value, PHP_URL_QUERY );
	}

	#[\Override]
	public function getFragment(): string {
		return (string) parse_url( $this->value, PHP_URL_FRAGMENT );
	}
}
