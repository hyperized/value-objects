<?php declare( strict_types=1 );

namespace Hyperized\ValueObjects\Abstracts\Spatial;

use Hyperized\ValueObjects\Contracts\Spatial\BoundingBoxInterface;
use Hyperized\ValueObjects\Contracts\Spatial\CoordinateInterface;
use Hyperized\ValueObjects\Exceptions\SpatialException;

abstract readonly class AbstractBoundingBox implements BoundingBoxInterface {
	protected CoordinateInterface $southwest;
	protected CoordinateInterface $northeast;

	final protected function __construct( CoordinateInterface $southwest, CoordinateInterface $northeast ) {
		static::validate( $southwest, $northeast );
		$this->southwest = $southwest;
		$this->northeast = $northeast;
	}

	protected static function validate( CoordinateInterface $southwest, CoordinateInterface $northeast ): void {
		if ( $southwest->getLatitude() > $northeast->getLatitude() ) {
			throw SpatialException::invalidBoundingBox();
		}
	}

	#[\Override]
	public static function fromCoordinates( CoordinateInterface $southwest, CoordinateInterface $northeast ): BoundingBoxInterface {
		return new static( $southwest, $northeast );
	}

	#[\Override]
	public function getSouthwest(): CoordinateInterface {
		return $this->southwest;
	}

	#[\Override]
	public function getNortheast(): CoordinateInterface {
		return $this->northeast;
	}

	#[\Override]
	public function contains( CoordinateInterface $point ): bool {
		$lat = $point->getLatitude();
		$lng = $point->getLongitude();

		return $lat >= $this->southwest->getLatitude()
			&& $lat <= $this->northeast->getLatitude()
			&& $lng >= $this->southwest->getLongitude()
			&& $lng <= $this->northeast->getLongitude();
	}
}
