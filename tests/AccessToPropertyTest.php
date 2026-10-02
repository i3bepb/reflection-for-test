<?php

declare(strict_types=1);

namespace I3bepb\ReflectionForTest\Tests;

use I3bepb\ReflectionForTest\AccessToProperty;
use I3bepb\ReflectionForTest\Tests\Mock\ClassWithPrivateProperty;
use I3bepb\ReflectionForTest\Tests\Mock\ClassWithProtectedProperty;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionException;

final class AccessToPropertyTest extends TestCase
{
    use AccessToProperty;

    public function testReadsPrivateProperty(): void
    {
        self::assertSame('private any', $this->getNonPublicProperty(new ClassWithPrivateProperty(), 'privateProperty'));
    }

    public function testReadsProtectedProperty(): void
    {
        self::assertSame('protected any', $this->getNonPublicProperty(new ClassWithProtectedProperty(), 'protectedProperty'));
    }

    public function testSetsPrivatePropertyOnSpecifiedObject(): void
    {
        $object = new ClassWithPrivateProperty();
        $other = new ClassWithPrivateProperty();

        $this->setNonPublicProperty($object, 'privateProperty', 'changed');

        self::assertSame('changed', $object->value());
        self::assertSame('private any', $other->value());
        self::assertSame('changed', $this->getNonPublicProperty($object, 'privateProperty'));
    }

    public function testSetsProtectedProperty(): void
    {
        $object = new ClassWithProtectedProperty();

        $this->setNonPublicProperty($object, 'protectedProperty', 'changed');

        self::assertSame('changed', $object->value());
        self::assertSame('changed', $this->getNonPublicProperty($object, 'protectedProperty'));
    }

    public function testThrowsWhenReadingMissingProperty(): void
    {
        $this->expectException(ReflectionException::class);

        $this->getNonPublicProperty(new ClassWithPrivateProperty(), 'missingProperty');
    }

    public function testThrowsWhenSettingMissingProperty(): void
    {
        $this->expectException(ReflectionException::class);

        $this->setNonPublicProperty(new ClassWithPrivateProperty(), 'missingProperty', 'value');
    }

    #[DataProvider('propertyValues')]
    public function testPreservesPropertyValueAndType(mixed $value): void
    {
        $object = new class {
            private mixed $value = 'initial';

            public function value(): mixed
            {
                return $this->value;
            }
        };

        $this->setNonPublicProperty($object, 'value', $value);

        self::assertSame($value, $object->value());
        self::assertSame($value, $this->getNonPublicProperty($object, 'value'));
    }

    public static function propertyValues(): iterable
    {
        yield 'null' => [null];
        yield 'boolean' => [false];
        yield 'integer' => [0];
        yield 'float' => [1.5];
        yield 'string' => ['0'];
        yield 'array' => [['key' => 'value']];
        yield 'object' => [new \stdClass()];
    }
}
