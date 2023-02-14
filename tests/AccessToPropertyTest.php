<?php

namespace I3bepb\ReflectionForTest\Tests;

use I3bepb\ReflectionForTest\AccessToProperty;
use I3bepb\ReflectionForTest\Tests\Mock\ClassWithPrivateProperty;
use I3bepb\ReflectionForTest\Tests\Mock\ClassWithProtectedProperty;
use PHPUnit\Framework\TestCase;

class AccessToPropertyTest extends TestCase
{
    use AccessToProperty;

    /**
     * Check access to private property
     *
     * @covers \I3bepb\ReflectionForTest\AccessToProperty::getProtectedOrPrivatePropertyValue
     *
     * @test
     *
     * @throws \ReflectionException
     */
    public function check_access_to_private_property()
    {
        $object = new ClassWithPrivateProperty();

        $this->assertEquals('private any', $this->getProtectedOrPrivatePropertyValue($object, 'privateProperty'));
    }

    /**
     * Check access to protected property
     *
     * @covers \I3bepb\ReflectionForTest\AccessToProperty::getProtectedOrPrivatePropertyValue
     *
     * @test
     *
     * @throws \ReflectionException
     */
    public function check_access_to_protected_property()
    {
        $object = new ClassWithProtectedProperty();

        $this->assertEquals('protected any', $this->getProtectedOrPrivatePropertyValue($object, 'protectedProperty'));
    }
}
