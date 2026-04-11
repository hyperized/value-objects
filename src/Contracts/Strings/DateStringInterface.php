<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Strings;

interface DateStringInterface {
	public static function fromString( string $value ): DateStringInterface;

	public function getValue(): string;

	public function toDateTimeImmutable(): \DateTimeImmutable;
}
