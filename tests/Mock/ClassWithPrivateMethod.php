<?php

namespace I3bepb\ReflectionForTest\Tests\Mock;

class ClassWithPrivateMethod
{
    /**
     * Private method.
     *
     * @return string
     */
    private function foo()
    {
        // Any code...

        return 'result private method';
    }

    /**
     * Private method width parameters.
     *
     * @param  int  $a
     * @param  int  $b
     *
     * @return int
     */
    private function privateSum(int $a, int $b)
    {
        // Any code...

        return $a + $b;
    }
}
