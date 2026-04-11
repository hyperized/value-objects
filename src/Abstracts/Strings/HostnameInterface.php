<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

interface HostnameInterface {
	public static function fromString( string $value ): HostnameInterface;

	public function getValue(): string;
}
