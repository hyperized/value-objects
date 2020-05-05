# Value Objects

A basic PHP value objects collection.

## Install

_Notice_: Only dev-master available for now.
Use at own risk

```bash
composer require hyperized/value-objects:dev-master
```

## Examples

### Integer type

```php
<?php declare(strict_types=1);

use Hyperized\ValueObjects\Abstracts\Integers\Integer;

include 'vendor/autoload.php';

class MyObject extends Integer
{
    protected int $min = 100;
    protected int $max = 9999;
}

$myObject = new MyObject(666);

var_dump($myObject->getValue()); // int(666)

new MyObject(1); // InvalidArgumentException: MyObject cannot be lower than "100", was provided with "1"
```

### String type

```php
<?php declare(strict_types=1);

use Hyperized\ValueObjects\Abstracts\Strings\String;

include 'vendor/autoload.php';

class MyObject extends String {}

$myObject = new MyObject('Hello World!');

var_dump($myObject->getValue()); // string(12) "Hello World!"

new MyObject(''); // InvalidArgumentException: MyObject cannot be empty
```

## Licence

MIT

## Author

Gerben Geijteman <gerben@hyperized.net>
