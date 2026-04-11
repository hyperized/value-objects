<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Spatial;

use Hyperized\ValueObjects\Concretes\Spatial\Bearing;
use Hyperized\ValueObjects\Exceptions\SpatialException;
use PHPUnit\Framework\TestCase;

class BearingTest extends TestCase {
	public function testFromDegrees(): void {
		$b = Bearing::fromDegrees( 90.0 );
		self::assertSame( 90.0, $b->getValue() );
	}

	public function testCardinalNorth(): void {
		self::assertSame( 'N', Bearing::fromDegrees( 0.0 )->getCardinal() );
		self::assertSame( 'N', Bearing::fromDegrees( 350.0 )->getCardinal() );
		self::assertSame( 'N', Bearing::fromDegrees( 10.0 )->getCardinal() );
	}

	public function testCardinalNorthEast(): void {
		self::assertSame( 'NE', Bearing::fromDegrees( 45.0 )->getCardinal() );
	}

	public function testCardinalEast(): void {
		self::assertSame( 'E', Bearing::fromDegrees( 90.0 )->getCardinal() );
	}

	public function testCardinalSouthEast(): void {
		self::assertSame( 'SE', Bearing::fromDegrees( 135.0 )->getCardinal() );
	}

	public function testCardinalSouth(): void {
		self::assertSame( 'S', Bearing::fromDegrees( 180.0 )->getCardinal() );
	}

	public function testCardinalSouthWest(): void {
		self::assertSame( 'SW', Bearing::fromDegrees( 225.0 )->getCardinal() );
	}

	public function testCardinalWest(): void {
		self::assertSame( 'W', Bearing::fromDegrees( 270.0 )->getCardinal() );
	}

	public function testCardinalNorthWest(): void {
		self::assertSame( 'NW', Bearing::fromDegrees( 315.0 )->getCardinal() );
	}

	public function testCardinalBoundaries(): void {
		// Test exact boundary values — these fall into the next cardinal direction
		self::assertSame( 'NE', Bearing::fromDegrees( 22.5 )->getCardinal() );
		self::assertSame( 'E', Bearing::fromDegrees( 67.5 )->getCardinal() );
		self::assertSame( 'SE', Bearing::fromDegrees( 112.5 )->getCardinal() );
		self::assertSame( 'S', Bearing::fromDegrees( 157.5 )->getCardinal() );
		self::assertSame( 'SW', Bearing::fromDegrees( 202.5 )->getCardinal() );
		self::assertSame( 'W', Bearing::fromDegrees( 247.5 )->getCardinal() );
		self::assertSame( 'NW', Bearing::fromDegrees( 292.5 )->getCardinal() );
		self::assertSame( 'N', Bearing::fromDegrees( 337.5 )->getCardinal() );
	}

	public function testBoundaryZero(): void {
		$b = Bearing::fromDegrees( 0.0 );
		self::assertSame( 0.0, $b->getValue() );
	}

	public function testBoundary360(): void {
		$b = Bearing::fromDegrees( 360.0 );
		self::assertSame( 360.0, $b->getValue() );
	}

	public function testNegativeBearing(): void {
		$this->expectException( SpatialException::class );
		Bearing::fromDegrees( -1.0 );
	}

	public function testOver360(): void {
		$this->expectException( SpatialException::class );
		Bearing::fromDegrees( 361.0 );
	}
}
