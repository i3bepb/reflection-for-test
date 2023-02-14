<?php

namespace I3bepb\ReflectionForTest\Tests\Mock;

class ClassWithProtectedMethod
{
    /**
     * Protected Method.
     *
     * @return string
     */
    protected function xyz()
    {
        // Any code...

        return 'result protected method';
    }

    /**
     * Protected method width parameters.
     *
     * @param  int  $a
     * @param  int  $b
     *
     * @return int
     */
    private function protectedSum(int $a, int $b)
    {
        // Any code...

        return $a + $b;
    }
}
