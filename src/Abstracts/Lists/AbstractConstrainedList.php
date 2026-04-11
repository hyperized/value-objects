<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Lists;

use Hyperized\ValueObjects\Contracts\Lists\ConstrainedListInterface;
use Hyperized\ValueObjects\Exceptions\ListException;

abstract readonly class AbstractConstrainedList implements ConstrainedListInterface {
	/** @var array<string> */
	protected array $value;

	/**
	 * @param array<string> $value
	 */
	final protected function __construct( array $value ) {
		$this->value = $value;
	}

	/**
	 * @param array<string> $values
	 * @param array<string> $allowedValues
	 */
	#[\Override]
	public static function fromArray( array $values, array $allowedValues ): ConstrainedListInterface {
		$disallowed = array_find( $values, static fn( string $v ): bool => ! in_array( $v, $allowedValues, true ) );

		if ( $disallowed !== null ) {
			throw ListException::valueNotAllowed( $disallowed, $allowedValues );
		}

		return new static( $values );
	}

	#[\Override]
	public function getValue(): array {
		return $this->value;
	}

	#[\Override]
	public function contains( string $value ): bool {
		return in_array( $value, $this->value, true );
	}
}
