<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use DateTimeImmutable;
use Hyperized\ValueObjects\Concretes\Strings\DateString;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DateStringTest extends TestCase {
	public function testFromStringIso8601(): void {
		$date = DateString::fromString( '2024-01-15T10:30:00+00:00' );
		self::assertSame( '2024-01-15T10:30:00+00:00', $date->getValue() );
	}

	public function testFromStringDateOnly(): void {
		$date = DateString::fromString( '2024-01-15' );
		self::assertSame( '2024-01-15', $date->getValue() );
	}

	public function testFromStringDateTime(): void {
		$date = DateString::fromString( '2024-01-15T10:30:00' );
		self::assertSame( '2024-01-15T10:30:00', $date->getValue() );
	}

	public function testToDateTimeImmutable(): void {
		$date = DateString::fromString( '2024-01-15' );
		$dateTime = $date->toDateTimeImmutable();
		self::assertInstanceOf( DateTimeImmutable::class, $dateTime );
		self::assertSame( '2024-01-15', $dateTime->format( 'Y-m-d' ) );
	}

	public function testInvalidDateString(): void {
		$this->expectException( InvalidArgumentException::class );
		DateString::fromString( 'not-a-date' );
	}

	public function testEmptyDateString(): void {
		$this->expectException( InvalidArgumentException::class );
		DateString::fromString( '' );
	}
}
