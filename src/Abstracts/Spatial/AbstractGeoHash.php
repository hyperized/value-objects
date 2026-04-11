<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Spatial;

use Hyperized\ValueObjects\Contracts\Spatial\GeoHashInterface;
use Hyperized\ValueObjects\Exceptions\SpatialException;

abstract class AbstractGeoHash implements GeoHashInterface {
	protected static string $pattern = '/^[0-9b-hjkmnp-z]{1,12}$/';

	protected readonly string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = strtolower( $value );
	}

	protected static function validate( string $value ): void {
		if ( ! preg_match( static::$pattern, strtolower( $value ) ) ) {
			throw SpatialException::invalidGeoHash( $value );
		}
	}

	public static function fromString( string $value ): GeoHashInterface {
		return new static( $value );
	}

	public function getValue(): string {
		return $this->value;
	}

	public function getPrecision(): int {
		return strlen( $this->value );
	}
}
