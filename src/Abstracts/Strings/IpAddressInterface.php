<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

interface IpAddressInterface {
	public static function fromString( string $value ): IpAddressInterface;

	public function getValue(): string;

	public function isIPv4(): bool;

	public function isIPv6(): bool;
}
