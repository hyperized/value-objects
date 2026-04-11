<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Lists;

use Hyperized\ValueObjects\Concretes\Lists\ConstrainedList;
use Hyperized\ValueObjects\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ConstrainedListTest extends TestCase {
	public function testFromArray(): void {
		$list = ConstrainedList::fromArray( [ 'a', 'b' ], [ 'a', 'b', 'c' ] );
		self::assertSame( [ 'a', 'b' ], $list->getValue() );
	}

	public function testContains(): void {
		$list = ConstrainedList::fromArray( [ 'a', 'b' ], [ 'a', 'b', 'c' ] );
		self::assertTrue( $list->contains( 'a' ) );
		self::assertFalse( $list->contains( 'c' ) );
	}

	public function testDisallowedValue(): void {
		$this->expectException( InvalidArgumentException::class );
		ConstrainedList::fromArray( [ 'a', 'x' ], [ 'a', 'b', 'c' ] );
	}
}
