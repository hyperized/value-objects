<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Lists;

use Hyperized\ValueObjects\Contracts\Lists\ConstrainedListInterface;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;

abstract class AbstractConstrainedList implements ConstrainedListInterface {
	/** @var array<string> */
	protected readonly array $value;

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
	public static function fromArray( array $values, array $allowedValues ): ConstrainedListInterface {
		foreach ( $values as $value ) {
			if ( ! in_array( $value, $allowedValues, true ) ) {
				throw InvalidArgumentException::valueNotAllowed( $value, $allowedValues );
			}
		}

		return new static( $values );
	}

	public function getValue(): array {
		return $this->value;
	}

	public function contains( string $value ): bool {
		return in_array( $value, $this->value, true );
	}
}
