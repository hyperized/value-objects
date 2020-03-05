<?php declare(strict_types=1);

use Hyperized\ValueObjects\Abstracts\Integers\PositiveInteger;

include 'vendor/autoload.php';

//final class MyConcrete extends \Hyperized\ValueObjects\Abstracts\Integers\Octal {}
//
//print MyConcrete
//    ::fromInteger(0777)
//    ->getValue();


class Octal {
    public int $octal;

    public function __construct(int $octal)
    {
        $this->octal = $octal;
    }
}

$octal = new Octal(0777);
var_dump($octal->octal);
var_dump(octdec($octal->octal));
var_dump(octdec(decoct($octal->octal)));
var_dump(decoct($octal->octal));
var_dump(sprintf('0%o', $octal->octal));

var_dump(sprintf('0%o', $octal->octal));
var_dump((int) sprintf('0%o', $octal->octal));
