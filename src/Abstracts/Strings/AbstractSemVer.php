<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\SemVerInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract readonly class AbstractSemVer implements SemVerInterface {
	protected const string PATTERN = '/^v?(\d+)\.(\d+)\.(\d+)(?:-[\w.]+)?(?:\+[\w.]+)?$/';

	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( ! preg_match( static::PATTERN, $value ) ) {
			throw StringException::invalidSemVer( $value );
		}
	}

	#[\Override]
	public static function fromString( string $value ): SemVerInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): string {
		return $this->value;
	}

	#[\Override]
	public function getMajor(): int {
		preg_match( static::PATTERN, $this->value, $matches );

		return (int) $matches[1];
	}

	#[\Override]
	public function getMinor(): int {
		preg_match( static::PATTERN, $this->value, $matches );

		return (int) $matches[2];
	}

	#[\Override]
	public function getPatch(): int {
		preg_match( static::PATTERN, $this->value, $matches );

		return (int) $matches[3];
	}
}
