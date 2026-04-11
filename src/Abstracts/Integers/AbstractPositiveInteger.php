<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Exceptions\IntegerException;

abstract class AbstractPositiveInteger extends AbstractInteger {
	protected static function validate( int $value ): void {
		if ( $value <= 0 ) {
			throw IntegerException::negativeInteger();
		}
	}
}
