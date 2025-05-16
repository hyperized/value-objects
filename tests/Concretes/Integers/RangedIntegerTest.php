<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Integers;

use Hyperized\ValueObjects\Concretes\Integers\RangedInteger as RangedIntegerConcrete;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class RangedIntegerTest extends TestCase {
	protected static int $value = 1;
	protected static int $minimum = 0;
	protected static int $maximum = 1;
	protected static int $higher = 2;
	protected static int $lower = - 1;

	public function testFromRange(): void {
		assertSame(
			static::$value,
			RangedIntegerConcrete::fromRange( static::$value, static::$minimum, static::$maximum )->getValue()
		);
	}

	public function testFromRangeOutRangeHigh(): void {
		$this->expectException( InvalidArgumentException::class );
		RangedIntegerConcrete::fromRange( static::$higher, static::$minimum, static::$maximum );
	}

	public function testFromRangeOutRangeLow(): void {
		$this->expectException( InvalidArgumentException::class );
		RangedIntegerConcrete::fromRange( static::$lower, static::$minimum, static::$maximum );
	}
}
