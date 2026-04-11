<?php declare(strict_types=1);

/**
 * Geospatial value objects — modelling a flight from Amsterdam to New York.
 *
 * Run: php examples/geospatial.php
 */

require __DIR__ . '/../vendor/autoload.php';

use Hyperized\ValueObjects\Concretes\Spatial\Altitude;
use Hyperized\ValueObjects\Concretes\Spatial\Bearing;
use Hyperized\ValueObjects\Concretes\Spatial\BoundingBox;
use Hyperized\ValueObjects\Concretes\Spatial\Coordinate;
use Hyperized\ValueObjects\Concretes\Spatial\Distance;
use Hyperized\ValueObjects\Concretes\Spatial\GeoHash;
use Hyperized\ValueObjects\Concretes\Spatial\LineString;
use Hyperized\ValueObjects\Concretes\Spatial\Polygon;

// Airports
$schiphol = Coordinate::fromLatitudeAndLongitude(52.3105, 4.7683);
$jfk      = Coordinate::fromLatitudeAndLongitude(40.6413, -73.7781);

echo "=== Flight: Amsterdam Schiphol -> New York JFK ===\n\n";
echo "Departure: {$schiphol->getLatitude()}N, {$schiphol->getLongitude()}E\n";
echo "Arrival:   {$jfk->getLatitude()}N, {$jfk->getLongitude()}W\n";

// Flight distance and cruising altitude
$flightDistance = Distance::fromKilometers(5862.0);
echo "\nDistance: {$flightDistance->toKilometers()} km";
echo " / " . round($flightDistance->toMiles(), 1) . " mi";
echo " / " . round($flightDistance->toNauticalMiles(), 1) . " nm\n";

$cruisingAltitude = Altitude::fromFeet(35000.0);
echo "Cruising altitude: " . round($cruisingAltitude->toFeet()) . " ft";
echo " / " . round($cruisingAltitude->toMeters()) . " m\n";

// Dead Sea — negative altitude
$deadSea = Altitude::fromMeters(-430.5);
echo "Dead Sea: {$deadSea->toMeters()} m / " . round($deadSea->toFeet(), 1) . " ft\n";

// Initial bearing
$heading = Bearing::fromDegrees(288.0);
echo "\nInitial heading: {$heading->getValue()}° ({$heading->getCardinal()})\n";

// GeoHash for Schiphol
$hash = GeoHash::fromString('u173z');
echo "Schiphol geohash: {$hash->getValue()} (precision: {$hash->getPrecision()})\n";

// North Atlantic corridor as a bounding box
$corridorSW = Coordinate::fromLatitudeAndLongitude(40.0, -75.0);
$corridorNE = Coordinate::fromLatitudeAndLongitude(55.0, 5.0);
$corridor   = BoundingBox::fromCoordinates($corridorSW, $corridorNE);

echo "\n=== North Atlantic Corridor ===\n";
echo "SW corner: {$corridor->getSouthwest()->getLatitude()}N, {$corridor->getSouthwest()->getLongitude()}W\n";
echo "NE corner: {$corridor->getNortheast()->getLatitude()}N, {$corridor->getNortheast()->getLongitude()}E\n";
echo "Schiphol in corridor: " . ($corridor->contains($schiphol) ? 'yes' : 'no') . "\n";
echo "JFK in corridor:      " . ($corridor->contains($jfk) ? 'yes' : 'no') . "\n";

$tokyo = Coordinate::fromLatitudeAndLongitude(35.6762, 139.6503);
echo "Tokyo in corridor:    " . ($corridor->contains($tokyo) ? 'yes' : 'no') . "\n";

// Flight path as a LineString (simplified waypoints)
$waypoints = LineString::fromCoordinates([
    $schiphol,
    Coordinate::fromLatitudeAndLongitude(53.0, -10.0),   // Irish Sea
    Coordinate::fromLatitudeAndLongitude(54.0, -30.0),   // Mid-Atlantic
    Coordinate::fromLatitudeAndLongitude(49.0, -55.0),   // Newfoundland
    $jfk,
]);
echo "\nFlight path: {$waypoints->count()} waypoints\n";

// Airport perimeter as a Polygon (simplified)
$schipholPerimeter = Polygon::fromCoordinates([
    Coordinate::fromLatitudeAndLongitude(52.340, 4.720),
    Coordinate::fromLatitudeAndLongitude(52.340, 4.820),
    Coordinate::fromLatitudeAndLongitude(52.280, 4.820),
    Coordinate::fromLatitudeAndLongitude(52.280, 4.720),
]);
echo "Schiphol perimeter: {$schipholPerimeter->count()} vertices\n";

// Compass rose
echo "\n=== Compass Rose ===\n";
$directions = [0.0, 45.0, 90.0, 135.0, 180.0, 225.0, 270.0, 315.0];
foreach ($directions as $deg) {
    $b = Bearing::fromDegrees($deg);
    echo sprintf("  %5.1f° = %s\n", $b->getValue(), $b->getCardinal());
}
