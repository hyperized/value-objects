<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Strings;

interface UriInterface {
	public static function fromString( string $value ): UriInterface;

	public function getValue(): string;

	public function getScheme(): string;

	public function getHost(): string;

	public function getPath(): string;

	public function getQuery(): string;

	public function getFragment(): string;
}
