<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Enums\Spatial;

enum CardinalDirection: string {
	case North = 'N';
	case NorthEast = 'NE';
	case East = 'E';
	case SouthEast = 'SE';
	case South = 'S';
	case SouthWest = 'SW';
	case West = 'W';
	case NorthWest = 'NW';
}
