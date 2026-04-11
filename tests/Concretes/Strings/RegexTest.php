<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\Regex;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase {
	public function testFromString(): void {
		$regex = Regex::fromString( '/^[a-z]+$/' );
		self::assertSame( '/^[a-z]+$/', $regex->getValue() );
	}

	public function testMatches(): void {
		$regex = Regex::fromString( '/^[0-9]+$/' );
		self::assertTrue( $regex->matches( '123' ) );
		self::assertFalse( $regex->matches( 'abc' ) );
	}

	public function testInvalidRegex(): void {
		$this->expectException( InvalidArgumentException::class );
		Regex::fromString( '/[invalid' );
	}
}
