<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Exceptions\IntegerException;

abstract readonly class AbstractPort extends AbstractInteger {
	#[\Override]
	protected static function validate( int $value ): void {
		if ( $value < 1 || $value > 65535 ) {
			throw IntegerException::invalidPort( $value );
		}
	}
}
