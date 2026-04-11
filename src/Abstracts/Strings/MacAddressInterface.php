<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

interface MacAddressInterface {
	public static function fromString( string $value ): MacAddressInterface;

	public function getValue(): string;
}
