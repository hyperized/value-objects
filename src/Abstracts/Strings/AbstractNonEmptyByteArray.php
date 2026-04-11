<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Exceptions\StringException;

abstract class AbstractNonEmptyByteArray extends AbstractByteArray {
	protected static function validate( string $value ): void {
		if ( '' === $value ) {
			throw StringException::emptyString();
		}
	}
}