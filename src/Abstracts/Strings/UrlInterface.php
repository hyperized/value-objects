<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

interface UrlInterface {
	public static function fromString( string $value ): UrlInterface;

	public function getValue(): string;

	public function getScheme(): string;

	public function getHost(): string;

	public function getPath(): string;
}
