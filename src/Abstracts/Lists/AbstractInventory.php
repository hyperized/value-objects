<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Lists;

use Hyperized\ValueObjects\Contracts\Lists\ListInterface;
use Hyperized\ValueObjects\Exceptions\ListException;
use function explode;

/**
 * Lists is a reserved name, inventory sort of covers it.
 */
abstract class AbstractInventory implements ListInterface {
	/** @var array<string> */
	protected readonly array $value;

	/**
	 * @param array<string> $value
	 */
	final protected function __construct( array $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	/**
	 * @param array<string> $value
	 */
	protected static function validate( array $value ): void {
		//
	}

	public static function fromCommaSeparatedString( string $value ): ListInterface {
		if ( ! self::stringContainsComma( $value ) ) {
			throw ListException::notACommaSeparatedString();
		}

		return new static( explode( ',', $value ) );
	}

	private static function stringContainsComma( string $haystack ): bool {
		return mb_strpos( $haystack, ',' ) !== false;
	}

	public function getValue(): array {
		return $this->value;
	}

	public function contains( string $value ): bool {
		return in_array( $value, $this->value );
	}
}
