<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Strings;

interface HostnameInterface {
	public static function fromString( string $value ): HostnameInterface;

	public function getValue(): string;
}
