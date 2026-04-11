<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\RealNumbers;

use Hyperized\ValueObjects\Concretes\RealNumbers\Percentage;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use Hyperized\ValueObjects\Exceptions\RealNumberException;
use PHPUnit\Framework\TestCase;

class PercentageTest extends TestCase {
	public function testFromFloat(): void {
		self::assertSame( 50.5, Percentage::fromFloat( 50.5 )->getValue() );
	}

	public function testFromInteger(): void {
		self::assertSame( 75.0, Percentage::fromInteger( 75 )->getValue() );
	}

	public function testFromString(): void {
		self::assertSame( 33.3, Percentage::fromString( '33.3' )->getValue() );
	}

	public function testZeroPercent(): void {
		self::assertSame( 0.0, Percentage::fromFloat( 0.0 )->getValue() );
	}

	public function testHundredPercent(): void {
		self::assertSame( 100.0, Percentage::fromFloat( 100.0 )->getValue() );
	}

	public function testAsFraction(): void {
		self::assertSame( 0.5, Percentage::fromFloat( 50.0 )->asFraction() );
	}

	public function testTooHigh(): void {
		$this->expectException( RealNumberException::class );
		Percentage::fromFloat( 100.1 );
	}

	public function testTooLow(): void {
		$this->expectException( RealNumberException::class );
		Percentage::fromFloat( -0.1 );
	}

	public function testFromStringNonNumeric(): void {
		$this->expectException( InvalidArgumentException::class );
		Percentage::fromString( 'abc' );
	}
}
