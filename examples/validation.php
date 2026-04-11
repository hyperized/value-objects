<?php declare(strict_types=1);

/**
 * Demonstrating validation behavior — all value objects reject invalid input on construction.
 *
 * Run: php examples/validation.php
 */

require __DIR__ . '/../vendor/autoload.php';

use Hyperized\ValueObjects\Concretes\Integers\PositiveInteger;
use Hyperized\ValueObjects\Concretes\Integers\Port;
use Hyperized\ValueObjects\Concretes\RealNumbers\Percentage;
use Hyperized\ValueObjects\Concretes\Spatial\Coordinate;
use Hyperized\ValueObjects\Concretes\Strings\Email;
use Hyperized\ValueObjects\Concretes\Strings\Uuid;
use Hyperized\ValueObjects\Concretes\Strings\IpAddress;
use Hyperized\ValueObjects\Concretes\Strings\SemVer;
use Hyperized\ValueObjects\Concretes\Strings\Json;
use Hyperized\ValueObjects\Concretes\Lists\ConstrainedList;

$cases = [
    'PositiveInteger(0)'    => fn() => PositiveInteger::fromInteger(0),
    'PositiveInteger(-5)'   => fn() => PositiveInteger::fromInteger(-5),
    'Port(0)'               => fn() => Port::fromInteger(0),
    'Port(70000)'           => fn() => Port::fromInteger(70000),
    'Percentage(101)'       => fn() => Percentage::fromFloat(101.0),
    'Percentage(-1)'        => fn() => Percentage::fromFloat(-1.0),
    'Coordinate(91, 0)'     => fn() => Coordinate::fromLatitudeAndLongitude(91.0, 0.0),
    'Coordinate(0, 181)'    => fn() => Coordinate::fromLatitudeAndLongitude(0.0, 181.0),
    'Email(not-an-email)'   => fn() => Email::fromString('not-an-email'),
    'Uuid(invalid)'         => fn() => Uuid::fromString('not-a-uuid'),
    'IpAddress(999.0.0.1)'  => fn() => IpAddress::fromString('999.0.0.1'),
    'SemVer(1.2)'           => fn() => SemVer::fromString('1.2'),
    'Json({invalid})'       => fn() => Json::fromString('{invalid}'),
    'ConstrainedList'       => fn() => ConstrainedList::fromArray(['x'], ['a', 'b']),
];

foreach ($cases as $label => $fn) {
    try {
        $fn();
        echo "PASS  {$label} — no exception (unexpected)\n";
    } catch (\InvalidArgumentException $e) {
        echo "CATCH {$label} — {$e->getMessage()}\n";
    }
}
