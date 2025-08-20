<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

interface OctalIntegerInterface extends IntegerInterface {
	public function asDecimal(): int;

	public function asDecimalString(): string;
}
