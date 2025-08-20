<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

interface ByteArrayInterface {
	public static function fromString( string $value ): ByteArrayInterface;

	public function getValue(): string;
}
