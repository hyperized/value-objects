<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractSemVer implements SemVerInterface {
	protected static string $pattern = '/^v?(\d+)\.(\d+)\.(\d+)(?:-[\w.]+)?(?:\+[\w.]+)?$/';

	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( ! preg_match( static::$pattern, $value ) ) {
			throw InvalidArgumentException::invalidSemVer( $value );
		}
	}

	public static function fromString( string $value ): SemVerInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}

	public function getMajor(): int {
		preg_match( static::$pattern, $this->value, $matches );

		return (int) $matches[1];
	}

	public function getMinor(): int {
		preg_match( static::$pattern, $this->value, $matches );

		return (int) $matches[2];
	}

	public function getPatch(): int {
		preg_match( static::$pattern, $this->value, $matches );

		return (int) $matches[3];
	}
}
