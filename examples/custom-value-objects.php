<?php declare(strict_types=1);

/**
 * Creating custom value objects by extending abstracts.
 *
 * Run: php examples/custom-value-objects.php
 */

require __DIR__ . '/../vendor/autoload.php';

use Hyperized\ValueObjects\Abstracts\Strings\AbstractEmail;
use Hyperized\ValueObjects\Abstracts\Integers\AbstractRangedInteger;
use Hyperized\ValueObjects\Contracts\Integers\IntegerInterface;
use Hyperized\ValueObjects\Abstracts\Strings\AbstractByteArray;

/**
 * A company email that must end with @company.com
 */
readonly class CompanyEmail extends AbstractEmail
{
    #[\Override]
    protected static function validate(string $value): void
    {
        parent::validate($value);

        if (!str_ends_with($value, '@company.com')) {
            throw new \InvalidArgumentException("Email must be a @company.com address, got: '{$value}'");
        }
    }
}

/**
 * An HTTP status code (100-599)
 */
readonly class HttpStatusCode extends AbstractRangedInteger
{
    #[\Override]
    public static function fromInteger(int $value): IntegerInterface
    {
        return self::fromRange($value, 100, 599);
    }
}

/**
 * A non-blank string (no whitespace-only strings)
 */
readonly class NonBlankString extends AbstractByteArray
{
    #[\Override]
    protected static function validate(string $value): void
    {
        if (trim($value) === '') {
            throw new \InvalidArgumentException('String must not be blank');
        }
    }
}

// CompanyEmail
$email = CompanyEmail::fromString('alice@company.com');
echo "Company email: {$email->getValue()}\n";
echo "Local part: {$email->getLocalPart()}\n";

try {
    CompanyEmail::fromString('alice@gmail.com');
} catch (\InvalidArgumentException $e) {
    echo "Rejected: {$e->getMessage()}\n";
}

// HttpStatusCode
$status = HttpStatusCode::fromInteger(200);
echo "\nHTTP status: {$status->getValue()}\n";

try {
    HttpStatusCode::fromInteger(999);
} catch (\InvalidArgumentException $e) {
    echo "Rejected: {$e->getMessage()}\n";
}

// NonBlankString
$name = NonBlankString::fromString('Alice');
echo "\nName: {$name->getValue()}\n";

try {
    NonBlankString::fromString('   ');
} catch (\InvalidArgumentException $e) {
    echo "Rejected: {$e->getMessage()}\n";
}
