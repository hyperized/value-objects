<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractPort extends AbstractInteger {
	protected static function validate( int $value ): void {
		if ( $value < 1 || $value > 65535 ) {
			throw InvalidArgumentException::invalidPort( $value );
		}
	}
}
