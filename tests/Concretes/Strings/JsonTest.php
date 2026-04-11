<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Tests\Concretes\Strings;

use Hyperized\ValueObjects\Concretes\Strings\Json;
use Hyperized\ValueObjects\Exceptions\StringException;
use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase {
	public function testFromString(): void {
		$json = Json::fromString( '{"key":"value"}' );
		self::assertSame( '{"key":"value"}', $json->getValue() );
	}

	public function testDecode(): void {
		$json = Json::fromString( '{"key":"value"}' );
		self::assertSame( [ 'key' => 'value' ], $json->decode() );
	}

	public function testDecodeArray(): void {
		$json = Json::fromString( '[1,2,3]' );
		self::assertSame( [ 1, 2, 3 ], $json->decode() );
	}

	public function testInvalidJson(): void {
		$this->expectException( StringException::class );
		Json::fromString( '{invalid}' );
	}

	public function testEmptyStringJson(): void {
		$this->expectException( StringException::class );
		Json::fromString( '' );
	}
}
