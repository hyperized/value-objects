<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Strings;

interface UuidInterface {
	public static function fromString( string $value ): UuidInterface;

	public function getValue(): string;

	public function getVersion(): int;
}
