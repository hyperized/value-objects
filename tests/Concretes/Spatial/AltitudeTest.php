<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Spatial;

use Hyperized\ValueObjects\Concretes\Spatial\Altitude;
use PHPUnit\Framework\TestCase;

class AltitudeTest extends TestCase {
	public function testFromMeters(): void {
		$a = Altitude::fromMeters( 8848.86 );
		self::assertSame( 8848.86, $a->toMeters() );
		self::assertSame( 8848.86, $a->getValue() );
		self::assertSame( 'meters', $a->getUnit() );
	}

	public function testFromFeet(): void {
		$a = Altitude::fromFeet( 1000.0 );
		self::assertSame( 304.8, $a->toMeters() );
		self::assertEqualsWithDelta( 1000.0, $a->toFeet(), 0.0001 );
	}

	public function testNegativeAltitude(): void {
		$a = Altitude::fromMeters( -430.5 );
		self::assertSame( -430.5, $a->toMeters() );
	}

	public function testZeroAltitude(): void {
		$a = Altitude::fromMeters( 0.0 );
		self::assertSame( 0.0, $a->toMeters() );
	}

	public function testConversionRoundTrip(): void {
		$a = Altitude::fromFeet( 35000.0 );
		self::assertEqualsWithDelta( 35000.0, $a->toFeet(), 0.0001 );
		self::assertEqualsWithDelta( 10668.0, $a->toMeters(), 0.01 );
	}
}
