<?php

declare(strict_types=1);

namespace I3bepb\ReflectionForTest\Tests\Mock;

class ClassWithPrivateProperty
{
    private string $privateProperty = 'private any';

    public function value(): string
    {
        return $this->privateProperty;
    }
}
