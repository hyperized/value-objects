<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\SemVer;
use Hyperized\ValueObjects\Exceptions\StringException;
use PHPUnit\Framework\TestCase;

class SemVerTest extends TestCase {
	public function testFromString(): void {
		$version = SemVer::fromString( '1.2.3' );
		self::assertSame( '1.2.3', $version->getValue() );
	}

	public function testGetMajor(): void {
		self::assertSame( 1, SemVer::fromString( '1.2.3' )->getMajor() );
	}

	public function testGetMinor(): void {
		self::assertSame( 2, SemVer::fromString( '1.2.3' )->getMinor() );
	}

	public function testGetPatch(): void {
		self::assertSame( 3, SemVer::fromString( '1.2.3' )->getPatch() );
	}

	public function testWithVPrefix(): void {
		$version = SemVer::fromString( 'v2.0.1' );
		self::assertSame( 2, $version->getMajor() );
	}

	public function testWithPreRelease(): void {
		$version = SemVer::fromString( '1.0.0-alpha.1' );
		self::assertSame( '1.0.0-alpha.1', $version->getValue() );
	}

	public function testWithBuildMetadata(): void {
		$version = SemVer::fromString( '1.0.0+build.123' );
		self::assertSame( 0, $version->getPatch() );
	}

	public function testInvalidSemVer(): void {
		$this->expectException( StringException::class );
		SemVer::fromString( 'not-a-version' );
	}

	public function testIncompleteSemVer(): void {
		$this->expectException( StringException::class );
		SemVer::fromString( '1.2' );
	}
}
