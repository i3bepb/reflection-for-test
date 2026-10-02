<?php

declare(strict_types=1);

namespace I3bepb\ReflectionForTest;

trait AccessToMethod
{
    /**
     * Call protected/private method and return result.
     *
     * @param array<int|string, mixed> $parameters Positional or named arguments.
     *
     * @throws \ReflectionException
     */
    protected function invokeNonPublicMethod(object $object, string $methodName, array $parameters = []): mixed
    {
        $reflection = new \ReflectionClass($object);
        $method = $reflection->getMethod($methodName);
        return $method->invokeArgs($object, $parameters);
    }
}