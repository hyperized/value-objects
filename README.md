# Value Objects

A basic PHP value objects collection.

## Install

```bash
composer require hyperized/value-objects
```

## Examples

### Integer type

```php
<?php declare(strict_types=1);

use Hyperized\ValueObjects\Abstracts\Integers\AbstractInteger;

include 'vendor/autoload.php';

// Implement concrete class for as value object
class MyObject extends AbstractInteger {}

$myObject = MyObject::fromInteger(1337);

var_dump($myObject->getValue()); // int(1337)
```

Other types that are offered:

* NegativeInteger.
	* Validates value is below 0 (zero).
* PositiveInteger
	* Validates value is above 0 (zero).
* RangedInteger.
	* Validates value is higher than minimum.
	* Validates value is lower than maximum.
	* By default minimum value is `PHP_INT_MIN` and maximum value `PHP_INT_MAX`.
* Octal.
	* Validates value is octal.

### String type (ByteArray)

Strings are called ByteArrays due to string being a reserved word in PHP.

```php
<?php declare(strict_types=1);

use Hyperized\ValueObjects\Abstracts\Strings\AbstractByteArray;

include 'vendor/autoload.php';

class MyObject extends AbstractByteArray {}

$myObject = MyObject::fromString('Hello world!');
var_dump($myObject->getValue()); // string('Hello world');
```

Other types that are offered:

* EmptyByteArray.
    * Validates value equals '' (empty string)
* NonEmptyByteArray.
    * Validates value does not equal '' (empty string)

## Licence

MIT

## Author

Gerben Geijteman <gerben@hyperized.net>
