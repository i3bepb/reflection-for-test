<?php

declare(strict_types=1);

namespace I3bepb\ReflectionForTest\Tests;

use I3bepb\ReflectionForTest\AccessToMethod;
use I3bepb\ReflectionForTest\Tests\Mock\ClassWithPrivateMethod;
use I3bepb\ReflectionForTest\Tests\Mock\ClassWithProtectedMethod;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use RuntimeException;

final class AccessToMethodTest extends TestCase
{
    use AccessToMethod;

    public function testInvokesPrivateMethod(): void
    {
        self::assertSame('result private method', $this->invokeNonPublicMethod(new ClassWithPrivateMethod(), 'foo'));
    }

    public function testInvokesPrivateMethodWithParameters(): void
    {
        self::assertSame(3, $this->invokeNonPublicMethod(new ClassWithPrivateMethod(), 'privateSum', [1, 2]));
    }

    public function testInvokesProtectedMethod(): void
    {
        self::assertSame('result protected method', $this->invokeNonPublicMethod(new ClassWithProtectedMethod(), 'xyz'));
    }

    public function testInvokesProtectedMethodWithParameters(): void
    {
        self::assertSame(3, $this->invokeNonPublicMethod(new ClassWithProtectedMethod(), 'protectedSum', [1, 2]));
    }

    public function testThrowsForMissingMethod(): void
    {
        $this->expectException(ReflectionException::class);

        $this->invokeNonPublicMethod(new ClassWithPrivateMethod(), 'missingMethod');
    }

    public function testPassesNamedArguments(): void
    {
        $object = new class {
            private function join(string $first, string $second): string
            {
                return $first . $second;
            }
        };

        self::assertSame('ab', $this->invokeNonPublicMethod($object, 'join', ['second' => 'b', 'first' => 'a']));
    }

    public function testPreservesReturnedObjectIdentity(): void
    {
        $object = new class {
            private function identity(object $value): object
            {
                return $value;
            }
        };
        $value = new \stdClass();

        self::assertSame($value, $this->invokeNonPublicMethod($object, 'identity', [$value]));
    }

    public function testReturnsNullForVoidMethodAndPreservesSideEffects(): void
    {
        $object = new class {
            public bool $called = false;

            private function run(): void
            {
                $this->called = true;
            }
        };

        self::assertSame(null, $this->invokeNonPublicMethod($object, 'run'));
        self::assertSame(true, $object->called);
    }

    public function testPropagatesExceptionFromMethod(): void
    {
        $exception = new RuntimeException('Method failed');
        $object = new class($exception) {
            public function __construct(private RuntimeException $exception)
            {
            }

            private function fail(): void
            {
                throw $this->exception;
            }
        };

        $this->expectExceptionObject($exception);

        $this->invokeNonPublicMethod($object, 'fail');
    }
}
