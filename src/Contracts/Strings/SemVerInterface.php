<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Strings;

interface SemVerInterface {
	public static function fromString( string $value ): SemVerInterface;

	public function getValue(): string;

	public function getMajor(): int;

	public function getMinor(): int;

	public function getPatch(): int;
}
