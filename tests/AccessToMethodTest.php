<?php

namespace I3bepb\ReflectionForTest\Tests;

use I3bepb\ReflectionForTest\AccessToMethod;
use I3bepb\ReflectionForTest\Tests\Mock\ClassWithPrivateMethod;
use I3bepb\ReflectionForTest\Tests\Mock\ClassWithProtectedMethod;
use PHPUnit\Framework\TestCase;

class AccessToMethodTest extends TestCase
{
    use AccessToMethod;

    /**
     * Check access to private method.
     *
     * @covers \I3bepb\ReflectionForTest\AccessToMethod::privateMethodWithParameters
     *
     * @test
     *
     * @throws \ReflectionException
     */
    public function check_access_to_private_method()
    {
        $object = new ClassWithPrivateMethod();

        $this->assertEquals('result private method', $this->privateMethodWithParameters($object, 'foo'));
    }

    /**
     * Check access to private method width parameters.
     *
     * @covers \I3bepb\ReflectionForTest\AccessToMethod::privateMethodWithParameters
     *
     * @test
     *
     * @throws \ReflectionException
     */
    public function check_access_to_private_method_with_parameters()
    {
        $object = new ClassWithPrivateMethod();

        $this->assertEquals(3, $this->privateMethodWithParameters($object, 'privateSum', [1, 2]));
    }

    /**
     * Check access to protected method.
     *
     * @covers \I3bepb\ReflectionForTest\AccessToMethod::privateMethodWithParameters
     *
     * @test
     *
     * @throws \ReflectionException
     */
    public function check_access_to_protected_method()
    {
        $object = new ClassWithProtectedMethod();

        $this->assertEquals('result protected method', $this->privateMethodWithParameters($object, 'xyz'));
    }

    /**
     * Check access to protected method width parameters.
     *
     * @covers \I3bepb\ReflectionForTest\AccessToMethod::privateMethodWithParameters
     *
     * @test
     *
     * @throws \ReflectionException
     */
    public function check_access_to_protected_method_with_parameters()
    {
        $object = new ClassWithProtectedMethod();

        $this->assertEquals(3, $this->privateMethodWithParameters($object, 'protectedSum', [1, 2]));
    }
}
