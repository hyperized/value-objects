<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\Uri;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UriTest extends TestCase {
	public function testFromString(): void {
		$uri = Uri::fromString( 'https://example.com/path?key=value#section' );
		self::assertSame( 'https://example.com/path?key=value#section', $uri->getValue() );
	}

	public function testGetScheme(): void {
		self::assertSame( 'https', Uri::fromString( 'https://example.com' )->getScheme() );
	}

	public function testGetHost(): void {
		self::assertSame( 'example.com', Uri::fromString( 'https://example.com/path' )->getHost() );
	}

	public function testGetPath(): void {
		self::assertSame( '/path/to/resource', Uri::fromString( 'https://example.com/path/to/resource' )->getPath() );
	}

	public function testGetQuery(): void {
		self::assertSame( 'key=value&foo=bar', Uri::fromString( 'https://example.com?key=value&foo=bar' )->getQuery() );
	}

	public function testGetFragment(): void {
		self::assertSame( 'section', Uri::fromString( 'https://example.com#section' )->getFragment() );
	}

	public function testEmptyOptionalParts(): void {
		$uri = Uri::fromString( 'https://example.com' );
		self::assertSame( '', $uri->getQuery() );
		self::assertSame( '', $uri->getFragment() );
	}

	public function testMailtoUri(): void {
		$uri = Uri::fromString( 'mailto:user@example.com' );
		self::assertSame( 'mailto', $uri->getScheme() );
		self::assertSame( 'user@example.com', $uri->getPath() );
	}

	public function testCustomScheme(): void {
		$uri = Uri::fromString( 'myapp://resource/123' );
		self::assertSame( 'myapp', $uri->getScheme() );
	}

	public function testNoScheme(): void {
		$this->expectException( InvalidArgumentException::class );
		Uri::fromString( '/just/a/path' );
	}

	public function testSeriouslyMalformedUri(): void {
		$this->expectException( InvalidArgumentException::class );
		Uri::fromString( 'http:///example.com:port///path' );
	}
}
