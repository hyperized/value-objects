<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

interface EmailInterface {
	public static function fromString( string $value ): EmailInterface;

	public function getValue(): string;

	public function getLocalPart(): string;

	public function getDomain(): string;
}
