<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Integers;

interface HexadecimalInterface {
	public static function fromString( string $value ): HexadecimalInterface;

	public static function fromInteger( int $value ): HexadecimalInterface;

	public function getValue(): int;

	public function asHexString(): string;
}
