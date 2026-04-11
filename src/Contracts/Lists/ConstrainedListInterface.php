<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Lists;

interface ConstrainedListInterface {
	/**
	 * @param array<string> $values
	 * @param array<string> $allowedValues
	 */
	public static function fromArray( array $values, array $allowedValues ): ConstrainedListInterface;

	/**
	 * @return array<string>
	 */
	public function getValue(): array;

	public function contains( string $value ): bool;
}
