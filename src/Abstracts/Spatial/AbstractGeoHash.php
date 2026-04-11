<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Spatial;

use Hyperized\ValueObjects\Contracts\Spatial\GeoHashInterface;
use Hyperized\ValueObjects\Exceptions\SpatialException;

abstract readonly class AbstractGeoHash implements GeoHashInterface {
	protected const string PATTERN = '/^[0-9b-hjkmnp-z]{1,12}$/';

	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = strtolower( $value );
	}

	protected static function validate( string $value ): void {
		if ( ! preg_match( static::PATTERN, strtolower( $value ) ) ) {
			throw SpatialException::invalidGeoHash( $value );
		}
	}

	#[\Override]
	public static function fromString( string $value ): GeoHashInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): string {
		return $this->value;
	}

	#[\Override]
	public function getPrecision(): int {
		return strlen( $this->value );
	}
}
