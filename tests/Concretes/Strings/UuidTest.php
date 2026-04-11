<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\Uuid;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase {
	public function testFromString(): void {
		$uuid = Uuid::fromString( '550e8400-e29b-41d4-a716-446655440000' );
		self::assertSame( '550e8400-e29b-41d4-a716-446655440000', $uuid->getValue() );
	}

	public function testNormalizesToLowercase(): void {
		$uuid = Uuid::fromString( '550E8400-E29B-41D4-A716-446655440000' );
		self::assertSame( '550e8400-e29b-41d4-a716-446655440000', $uuid->getValue() );
	}

	public function testGetVersionV4(): void {
		self::assertSame( 4, Uuid::fromString( '550e8400-e29b-41d4-a716-446655440000' )->getVersion() );
	}

	public function testGetVersionV7(): void {
		self::assertSame( 7, Uuid::fromString( '01932c07-209c-7be4-a29e-1e4e9a2b3c4d' )->getVersion() );
	}

	public function testInvalidUuid(): void {
		$this->expectException( InvalidArgumentException::class );
		Uuid::fromString( 'not-a-uuid' );
	}

	public function testTooShortUuid(): void {
		$this->expectException( InvalidArgumentException::class );
		Uuid::fromString( '550e8400-e29b-41d4-a716' );
	}
}
