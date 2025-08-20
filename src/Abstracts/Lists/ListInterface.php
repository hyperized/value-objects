<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Lists;

interface ListInterface {
	public static function fromCommaSeperatedString( string $value ): ListInterface;

	/**
	 * @return array<string>
	 */
	public function getValue(): array;

	public function contains( string $value ): bool;
}
