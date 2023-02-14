<?php

namespace I3bepb\ReflectionForTest;

trait AccessToMethod
{
    /**
     * Call protected/private method and return result.
     *
     * @param mixed  $object
     * @param string $methodName  Name method
     * @param array  $parameters  Arguments method
     *
     * @return mixed
     *
     * @throws \ReflectionException
     */
    protected function privateMethodWithParameters($object, string $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}