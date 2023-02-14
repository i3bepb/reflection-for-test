<?php

namespace I3bepb\ReflectionForTest;

trait AccessToProperty
{
    /**
     * Return protected/private property value.
     *
     * @param  mixed  $object
     * @param  string $prop     Name property
     *
     * @return mixed
     *
     * @throws \ReflectionException
     */
    protected function getProtectedOrPrivatePropertyValue($object, string $prop)
    {
        $reflection = new \ReflectionClass($object);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($object);
    }
}