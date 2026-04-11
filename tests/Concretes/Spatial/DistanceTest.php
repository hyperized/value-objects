<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Spatial;

use Hyperized\ValueObjects\Concretes\Spatial\Distance;
use Hyperized\ValueObjects\Exceptions\SpatialException;
use PHPUnit\Framework\TestCase;

class DistanceTest extends TestCase {
	public function testFromMeters(): void {
		$d = Distance::fromMeters( 1000.0 );
		self::assertSame( 1000.0, $d->toMeters() );
		self::assertSame( 1000.0, $d->getValue() );
		self::assertSame( 'meters', $d->getUnit() );
	}

	public function testFromKilometers(): void {
		$d = Distance::fromKilometers( 1.0 );
		self::assertSame( 1000.0, $d->toMeters() );
		self::assertSame( 1.0, $d->toKilometers() );
	}

	public function testFromMiles(): void {
		$d = Distance::fromMiles( 1.0 );
		self::assertSame( 1609.344, $d->toMeters() );
		self::assertEqualsWithDelta( 1.0, $d->toMiles(), 0.0001 );
	}

	public function testFromFeet(): void {
		$d = Distance::fromFeet( 1.0 );
		self::assertSame( 0.3048, $d->toMeters() );
		self::assertEqualsWithDelta( 1.0, $d->toFeet(), 0.0001 );
	}

	public function testFromNauticalMiles(): void {
		$d = Distance::fromNauticalMiles( 1.0 );
		self::assertSame( 1852.0, $d->toMeters() );
		self::assertEqualsWithDelta( 1.0, $d->toNauticalMiles(), 0.0001 );
	}

	public function testZeroDistance(): void {
		$d = Distance::fromMeters( 0.0 );
		self::assertSame( 0.0, $d->toMeters() );
	}

	public function testNegativeDistance(): void {
		$this->expectException( SpatialException::class );
		Distance::fromMeters( -1.0 );
	}

	public function testConversionRoundTrip(): void {
		$d = Distance::fromKilometers( 5.0 );
		self::assertEqualsWithDelta( 5.0, $d->toKilometers(), 0.0001 );
		self::assertEqualsWithDelta( 5000.0, $d->toMeters(), 0.0001 );
		self::assertEqualsWithDelta( 3.10686, $d->toMiles(), 0.001 );
	}
}
