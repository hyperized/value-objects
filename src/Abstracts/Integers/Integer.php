<?php declare(strict_types=1);

namespace Hyperized\ValueObjects\Abstracts\Integers;

use Hyperized\ValueObjects\Interfaces\Integers\Integer as IntegerInterface;
use Hyperized\ValueObjects\Traits\Integers\Integer as IntegerTrait;

abstract class Integer implements IntegerInterface
{
    use IntegerTrait;
}
