<?php

declare(strict_types=1);

namespace I3bepb\ReflectionForTest;

trait AccessToProperty
{
    /**
     * Return protected/private property value.
     *
     * @throws \ReflectionException
     */
    protected function getNonPublicProperty(object $object, string $propertyName): mixed
    {
        $reflection = new \ReflectionClass($object);
        $property = $reflection->getProperty($propertyName);
        return $property->getValue($object);
    }

    /**
     * Set a protected/private property value.
     *
     * @throws \ReflectionException
     */
    protected function setNonPublicProperty(object $object, string $propertyName, mixed $value): void
    {
        $reflection = new \ReflectionClass($object);
        $property = $reflection->getProperty($propertyName);
        $property->setValue($object, $value);
    }
}