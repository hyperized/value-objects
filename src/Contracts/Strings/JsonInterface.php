<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Strings;

interface JsonInterface {
	public static function fromString( string $value ): JsonInterface;

	public function getValue(): string;

	public function decode(): mixed;
}
