<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\UriInterface;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractUri implements UriInterface {
	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( parse_url( $value ) === false ) {
			throw InvalidArgumentException::invalidUri( $value );
		}

		if ( parse_url( $value, PHP_URL_SCHEME ) === null ) {
			throw InvalidArgumentException::invalidUri( $value );
		}
	}

	public static function fromString( string $value ): UriInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}

	public function getScheme(): string {
		return (string) parse_url( $this->value, PHP_URL_SCHEME );
	}

	public function getHost(): string {
		return (string) parse_url( $this->value, PHP_URL_HOST );
	}

	public function getPath(): string {
		return (string) parse_url( $this->value, PHP_URL_PATH );
	}

	public function getQuery(): string {
		return (string) parse_url( $this->value, PHP_URL_QUERY );
	}

	public function getFragment(): string {
		return (string) parse_url( $this->value, PHP_URL_FRAGMENT );
	}
}
