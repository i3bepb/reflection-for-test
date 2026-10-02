<?php

declare(strict_types=1);

namespace I3bepb\ReflectionForTest\Tests\Mock;

class ClassWithPrivateMethod
{
    private function foo(): string
    {
        return 'result private method';
    }

    private function privateSum(int $a, int $b): int
    {
        return $a + $b;
    }
}
