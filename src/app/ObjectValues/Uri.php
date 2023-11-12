<?php

namespace PhpObjectValues\App\ObjectValues;

use PhpObjectValues\App\ObjectValues\Contracts\ObjectValue;
use PhpObjectValues\App\Rules\UriRule;
use InvalidArgumentException;

class Uri extends ObjectValue
{
    public function __construct(protected mixed $value)
    {
        parent::__construct($value);
    }

    protected function validate(): void
    {
        $rule = new UriRule();

        if (!$rule->passes('', $this->value)) {
            throw new InvalidArgumentException('O valor informado não é uma URL válida.');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
