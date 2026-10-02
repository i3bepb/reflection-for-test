# Reflection for test

[![Latest Stable Version](https://img.shields.io/packagist/v/i3bepb/reflection-for-test.svg)](https://packagist.org/packages/i3bepb/reflection-for-test)
[![Total Downloads](https://img.shields.io/packagist/dt/i3bepb/reflection-for-test.svg)](https://packagist.org/packages/i3bepb/reflection-for-test)

Traits for invoking private/protected methods and reading or changing private/protected properties in tests.

## Requirements and installation

Version 2 requires PHP `^8.1` (PHP 8.1 or later in the PHP 8 series).

After the 2.0.0 release is published:

```sh
composer require --dev i3bepb/reflection-for-test:^2.0
```

## Usage

Use `AccessToMethod` and `AccessToProperty` in your test class. All three helpers are protected instance methods.

```php
<?php

declare(strict_types=1);

use I3bepb\ReflectionForTest\AccessToMethod;
use I3bepb\ReflectionForTest\AccessToProperty;
use PHPUnit\Framework\TestCase;

final class Counter
{
    private int $count = 1;

    protected function add(int $amount): int
    {
        return $this->count + $amount;
    }
}

final class CounterTest extends TestCase
{
    use AccessToMethod;
    use AccessToProperty;

    public function testNonPublicMembers(): void
    {
        $counter = new Counter();

        // Invoke a private or protected method.
        self::assertSame(3, $this->invokeNonPublicMethod($counter, 'add', [2]));

        // Read a private or protected property.
        self::assertSame(1, $this->getNonPublicProperty($counter, 'count'));

        // Change a private or protected property.
        $this->setNonPublicProperty($counter, 'count', 10);

        self::assertSame(10, $this->getNonPublicProperty($counter, 'count'));
        self::assertSame(12, $this->invokeNonPublicMethod($counter, 'add', [2]));
    }
}
```

### Invoke non-public methods

`invokeNonPublicMethod(object $object, string $methodName, array $parameters = []): mixed`

Omit the third argument for methods without arguments. Pass a list for positional arguments or an associative array for named arguments, following PHP's argument ordering rules. The helper returns the method's result, including `null` for a `void` method. Exceptions thrown by the method propagate to the caller.

### Read and change non-public properties

`getNonPublicProperty(object $object, string $propertyName): mixed`

`setNonPublicProperty(object $object, string $propertyName, mixed $value): void`

The getter returns the property value. The setter changes the property on the supplied object and returns nothing.

All helpers use native Reflection behavior. A missing method or property throws `ReflectionException`; the setter does not create missing properties. PHP's property type, initialization, and readonly rules still apply. The helpers do not search ancestor classes for private properties.

## Migration from 1.x

Version 2.0.0 is a breaking release, with no aliases for the old API:

| 1.x | 2.x |
| --- | --- |
| `privateMethodWithParameters()` | `invokeNonPublicMethod()` |
| `getProtectedOrPrivatePropertyValue()` | `getNonPublicProperty()` |
| — | `setNonPublicProperty()` |

The namespace `I3bepb\ReflectionForTest` and trait names remain unchanged. Helpers require an object; class-name strings are not accepted. PHP 7.x and PHP 8.0 remain on the `1.x` branch.

## Run tests

From a checkout, with PHP 8.1+ and Composer installed:

```sh
composer install
composer test
```

To run a specific test class:

```sh
composer test -- --filter AccessToPropertyTest
```

The test suite uses PHPUnit 10.5, the latest PHPUnit series compatible with PHP 8.1. GitHub Actions runs it on PHP 8.1, 8.2, 8.3, 8.4, and 8.5.
