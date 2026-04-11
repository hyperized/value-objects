<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

interface RegexInterface {
	public static function fromString( string $value ): RegexInterface;

	public function getValue(): string;

	public function matches( string $subject ): bool;
}
