<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Contracts\Integers;

interface OctalIntegerInterface extends IntegerInterface {
	public function asDecimal(): int;

	public function asDecimalString(): string;
}
