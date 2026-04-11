<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

use Hyperized\ValueObjects\Contracts\Strings\IpAddressInterface;
use Hyperized\ValueObjects\Exceptions\StringException;

abstract readonly class AbstractIpAddress implements IpAddressInterface {
	protected string $value;

	final protected function __construct( string $value ) {
		static::validate( $value );
		$this->value = $value;
	}

	protected static function validate( string $value ): void {
		if ( filter_var( $value, FILTER_VALIDATE_IP ) === false ) {
			throw StringException::invalidIpAddress( $value );
		}
	}

	#[\Override]
	public static function fromString( string $value ): IpAddressInterface {
		return new static( $value );
	}

	#[\Override]
	public function getValue(): string {
		return $this->value;
	}

	#[\Override]
	public function isIPv4(): bool {
		return filter_var( $this->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) !== false;
	}

	#[\Override]
	public function isIPv6(): bool {
		return filter_var( $this->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 ) !== false;
	}
}
