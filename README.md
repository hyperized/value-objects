# Value Objects

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fhyperized%2Fvalue-objects.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2Fhyperized%2Fvalue-objects?ref=badge_shield)

A typed, immutable value objects collection for PHP 8.4+.

All value objects validate on construction, are immutable (`readonly` classes), and follow the same pattern: extend an abstract, get validation for free.

## Install

```bash
composer require hyperized/value-objects
```

## Quick start

Use the provided concrete classes directly:

```php
use Hyperized\ValueObjects\Concretes\Strings\Email;
use Hyperized\ValueObjects\Concretes\Integers\Port;

$email = Email::fromString('user@example.com');
$email->getLocalPart(); // 'user'
$email->getDomain();    // 'example.com'

$port = Port::fromInteger(8080);
$port->getValue(); // 8080
```

Or extend an abstract to create your own domain-specific value object:

```php
use Hyperized\ValueObjects\Abstracts\Integers\AbstractPositiveInteger;

readonly class UserId extends AbstractPositiveInteger {}

$id = UserId::fromInteger(42);
$id->getValue(); // 42
```

## Available value objects

### Integers

| Class | Description |
|---|---|
| `Integer` | Any integer value |
| `PositiveInteger` | Must be > 0 |
| `NegativeInteger` | Must be < 0 |
| `NonNegativeInteger` | Must be >= 0 |
| `RangedInteger` | Within a min/max range (defaults to `PHP_INT_MIN`/`PHP_INT_MAX`) |
| `Octal` | Valid octal number with decimal conversion |
| `Hexadecimal` | Hex string parsing with `asHexString()` |
| `Port` | Network port (1-65535) |

### Real numbers

| Class | Description |
|---|---|
| `RealNumber` | Any float value |
| `Percentage` | Float between 0-100, with `asFraction()` |
### Spatial

| Class | Description |
|---|---|
| `Coordinate` | Latitude (-90/90) and longitude (-180/180) pair |
| `BoundingBox` | Southwest/northeast coordinate pair with `contains()` |
| `Distance` | Non-negative distance with unit conversions (m/km/mi/ft/nm) |
| `Bearing` | Compass heading (0-360) with `getCardinal()` |
| `Altitude` | Height above/below sea level with unit conversions (m/ft) |
| `GeoHash` | Base-32 encoded location string with `getPrecision()` |
| `Polygon` | Ordered list of coordinates (minimum 3 points) |
| `LineString` | Ordered list of coordinates (minimum 2 points) |

### Strings

| Class | Description |
|---|---|
| `ByteArray` | Any string value |
| `EmptyByteArray` | Must be empty |
| `NonEmptyByteArray` | Must be non-empty |
| `Email` | Validated email with `getLocalPart()` / `getDomain()` |
| `Url` | Validated URL with `getScheme()` / `getHost()` / `getPath()` |
| `Uri` | URI with scheme requirement, `getQuery()` / `getFragment()` |
| `Uuid` | RFC 4122 UUID, normalizes to lowercase, `getVersion()` |
| `IpAddress` | IPv4/IPv6 with `isIPv4()` / `isIPv6()` |
| `Hostname` | RFC-compliant, max 253 chars, normalized to lowercase |
| `MacAddress` | Colon or dash format, normalized to lowercase colon-separated |
| `Json` | Validated JSON string with `decode()` |
| `Regex` | Validated regex pattern with `matches()` |
| `SemVer` | Semantic version with `getMajor()` / `getMinor()` / `getPatch()` |
| `DateString` | ISO 8601 / Y-m-d date with `toDateTimeImmutable()` |

### Lists

| Class | Description |
|---|---|
| `Inventory` | From comma-separated string, with `contains()` |
| `ConstrainedList` | List with a set of allowed values |

## Extending

Every concrete class extends an abstract that you can extend for your own domain types. Override `validate()` to add custom rules:

```php
use Hyperized\ValueObjects\Abstracts\Strings\AbstractEmail;

readonly class CompanyEmail extends AbstractEmail
{
    #[\Override]
    protected static function validate(string $value): void
    {
        parent::validate($value);

        if (!str_ends_with($value, '@company.com')) {
            throw new \InvalidArgumentException('Must be a company email');
        }
    }
}
```

See the [examples/](examples/) directory for more usage patterns.

## Quality

```bash
composer test        # PHPStan (level 9) + PHPUnit
composer infection   # Mutation testing
```

## Licence

MIT

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fhyperized%2Fvalue-objects.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Fhyperized%2Fvalue-objects?ref=badge_large)

## Author

Gerben Geijteman <gerben@hyperized.net>
