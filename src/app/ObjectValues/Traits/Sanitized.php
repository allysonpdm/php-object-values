<?php

namespace PhpObjectValues\App\ObjectValues\Traits;

use PhpObjectValues\App\ObjectValues\Regex;

trait Sanitized
{
    protected Regex|string $regex;
    protected mixed $value;

    public function sanitized(): string
    {
        return preg_replace(
            $this->regex,
            '',
            (string) $this->value
        );
    }

    public function setRegex(Regex|string $regex): void
    {
        if (is_string($regex)) {
            $regex = new Regex($regex);
        }
        $this->regex = $regex;
    }

}
