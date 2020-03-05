<?php declare(strict_types=1);

use Hyperized\ValueObjects\Abstracts\Integers\Integer;
use Hyperized\ValueObjects\Abstracts\Integers\PositiveInteger;

include 'vendor/autoload.php';

Integer::fromInteger(666)->getValue(); // int(666)
$positive = PositiveInteger::fromInteger(1);
