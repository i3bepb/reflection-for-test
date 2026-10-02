<?php

declare(strict_types=1);

namespace I3bepb\ReflectionForTest\Tests\Mock;

class ClassWithProtectedProperty
{
    protected string $protectedProperty = 'protected any';

    public function value(): string
    {
        return $this->protectedProperty;
    }
}
