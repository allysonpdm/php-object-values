<?php

namespace App\ObjectValues\Contracts;

use Stringable;

abstract class ObjectValue implements Stringable
{
    public function __construct(protected mixed $value)
    {
        $this->validate($this->value);
    }

    protected abstract function validate(): void;
    public abstract function __toString();

    public function getValue(): mixed
    {
        return $this->value;
    }
}
