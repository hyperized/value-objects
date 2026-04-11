<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractUrl implements UrlInterface {
	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( filter_var( $value, FILTER_VALIDATE_URL ) === false ) {
			throw InvalidArgumentException::invalidUrl( $value );
		}
	}

	public static function fromString( string $value ): UrlInterface {
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
}
