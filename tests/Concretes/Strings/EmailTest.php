<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\Email;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase {
	public function testFromString(): void {
		$email = Email::fromString( 'user@example.com' );
		self::assertSame( 'user@example.com', $email->getValue() );
	}

	public function testGetLocalPart(): void {
		self::assertSame( 'user', Email::fromString( 'user@example.com' )->getLocalPart() );
	}

	public function testGetDomain(): void {
		self::assertSame( 'example.com', Email::fromString( 'user@example.com' )->getDomain() );
	}

	public function testInvalidEmail(): void {
		$this->expectException( InvalidArgumentException::class );
		Email::fromString( 'not-an-email' );
	}

	public function testEmptyStringEmail(): void {
		$this->expectException( InvalidArgumentException::class );
		Email::fromString( '' );
	}

	public function testEmailWithSubdomain(): void {
		$email = Email::fromString( 'user@sub.domain.example.com' );
		self::assertSame( 'sub.domain.example.com', $email->getDomain() );
	}
}
