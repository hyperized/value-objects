<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Lists;

use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use Hyperized\ValueObjects\Interfaces\Lists\ListInterface;
use function explode;

/**
 * Lists is a reserved name, inventory sort of covers it.
 */
class AbstractInventory implements ListInterface {
	/** @var array<string> */
	protected array $value;

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

	public static function fromCommaSeperatedString( string $value ): self {
		if ( ! self::stringContainsComma( $value ) ) {
			throw InvalidArgumentException::notACommaSeperatedString();
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
