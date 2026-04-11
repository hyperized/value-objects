<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use DateTimeImmutable;
use Hyperized\ValueObjects\Contracts\Strings\DateStringInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract class AbstractDateString implements DateStringInterface {
	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		$date = DateTimeImmutable::createFromFormat( DateTimeImmutable::ATOM, $value );

		if ( $date === false ) {
			$date = DateTimeImmutable::createFromFormat( 'Y-m-d', $value );
		}

		if ( $date === false ) {
			$date = DateTimeImmutable::createFromFormat( 'Y-m-d\TH:i:s', $value );
		}

		if ( $date === false ) {
			throw StringException::invalidDateString( $value );
		}
	}

	public static function fromString( string $value ): DateStringInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}

	public function toDateTimeImmutable(): DateTimeImmutable {
		return new DateTimeImmutable( $this->value );
	}
}
