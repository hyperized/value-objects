<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\Url;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase {
	public function testFromString(): void {
		$url = Url::fromString( 'https://example.com/path' );
		self::assertSame( 'https://example.com/path', $url->getValue() );
	}

	public function testGetScheme(): void {
		self::assertSame( 'https', Url::fromString( 'https://example.com' )->getScheme() );
	}

	public function testGetHost(): void {
		self::assertSame( 'example.com', Url::fromString( 'https://example.com/path' )->getHost() );
	}

	public function testGetPath(): void {
		self::assertSame( '/path/to/resource', Url::fromString( 'https://example.com/path/to/resource' )->getPath() );
	}

	public function testGetEmptyPath(): void {
		self::assertSame( '', Url::fromString( 'https://example.com' )->getPath() );
	}

	public function testInvalidUrl(): void {
		$this->expectException( InvalidArgumentException::class );
		Url::fromString( 'not a url' );
	}

	public function testHttpUrl(): void {
		self::assertSame( 'http', Url::fromString( 'http://example.com' )->getScheme() );
	}
}
