<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Spatial;

interface GeoHashInterface {
	public static function fromString( string $value ): GeoHashInterface;

	public function getValue(): string;

	public function getPrecision(): int;
}
