<?php

declare(strict_types=1);

namespace I3bepb\ReflectionForTest\Tests\Mock;

class ClassWithProtectedMethod
{
    protected function xyz(): string
    {
        return 'result protected method';
    }

    protected function protectedSum(int $a, int $b): int
    {
        return $a + $b;
    }
}
