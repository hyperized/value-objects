<?php declare(strict_types=1);

/**
 * Basic usage of concrete value objects.
 *
 * Run: php examples/basic-usage.php
 */

require __DIR__ . '/../vendor/autoload.php';

use Hyperized\ValueObjects\Concretes\Integers\Integer;
use Hyperized\ValueObjects\Concretes\Integers\PositiveInteger;
use Hyperized\ValueObjects\Concretes\Integers\NonNegativeInteger;
use Hyperized\ValueObjects\Concretes\Integers\RangedInteger;
use Hyperized\ValueObjects\Concretes\Integers\Port;
use Hyperized\ValueObjects\Concretes\Integers\Hexadecimal;
use Hyperized\ValueObjects\Concretes\RealNumbers\RealNumber;
use Hyperized\ValueObjects\Concretes\RealNumbers\Percentage;
use Hyperized\ValueObjects\Concretes\Spatial\Coordinate;
use Hyperized\ValueObjects\Concretes\Strings\ByteArray;
use Hyperized\ValueObjects\Concretes\Strings\Email;
use Hyperized\ValueObjects\Concretes\Strings\Url;
use Hyperized\ValueObjects\Concretes\Strings\Uuid;
use Hyperized\ValueObjects\Concretes\Strings\IpAddress;
use Hyperized\ValueObjects\Concretes\Lists\Inventory;

// Integers
$int = Integer::fromInteger(42);
echo "Integer: {$int->getValue()}\n";

$positive = PositiveInteger::fromInteger(1);
echo "Positive: {$positive->getValue()}\n";

$nonNeg = NonNegativeInteger::fromInteger(0);
echo "Non-negative (zero is valid): {$nonNeg->getValue()}\n";

$ranged = RangedInteger::fromRange(50, 1, 100);
echo "Ranged (1-100): {$ranged->getValue()}\n";

$port = Port::fromInteger(443);
echo "Port: {$port->getValue()}\n";

$hex = Hexadecimal::fromString('ff');
echo "Hex: {$hex->getValue()} -> {$hex->asHexString()}\n";

// Real numbers
$float = RealNumber::fromFloat(3.14);
echo "Float: {$float->getValue()}\n";

$pct = Percentage::fromFloat(85.5);
echo "Percentage: {$pct->getValue()}% = {$pct->asFraction()} as fraction\n";

$coord = Coordinate::fromLatitudeAndLongitude(52.3676, 4.9041);
echo "Coordinate: {$coord->getLatitude()}, {$coord->getLongitude()}\n";

// Strings
$str = ByteArray::fromString('Hello world');
echo "String: {$str->getValue()}\n";

$email = Email::fromString('user@example.com');
echo "Email: {$email->getLocalPart()} @ {$email->getDomain()}\n";

$url = Url::fromString('https://example.com/path');
echo "URL: {$url->getScheme()}://{$url->getHost()}{$url->getPath()}\n";

$uuid = Uuid::fromString('550e8400-e29b-41d4-a716-446655440000');
echo "UUID v{$uuid->getVersion()}: {$uuid->getValue()}\n";

$ip = IpAddress::fromString('192.168.1.1');
echo "IP: {$ip->getValue()} (IPv4: " . ($ip->isIPv4() ? 'yes' : 'no') . ")\n";

// Lists
$list = Inventory::fromCommaSeparatedString('apple,banana,cherry');
echo "List contains 'banana': " . ($list->contains('banana') ? 'yes' : 'no') . "\n";
