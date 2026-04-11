<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Contracts\Integers\IntegerInterface;
use Hyperized\ValueObjects\Exceptions\IntegerException;

abstract class AbstractRangedInteger extends AbstractInteger {
	public static function fromRange( int $value, int $minimum = PHP_INT_MIN, int $maximum = PHP_INT_MAX ): IntegerInterface {
		self::validateRange( $value, $minimum, $maximum );

		return new static( $value );
	}

	protected static function validateRange( int $value, int $minimum, int $maximum ): void {
		if ( $value < $minimum || $value > $maximum ) {
			throw IntegerException::outOfRange( $value, $minimum, $maximum );
		}
	}
}
