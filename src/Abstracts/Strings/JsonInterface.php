<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

interface JsonInterface {
	public static function fromString( string $value ): JsonInterface;

	public function getValue(): string;

	public function decode(): mixed;
}
