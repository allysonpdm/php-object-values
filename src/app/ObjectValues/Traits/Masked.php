<?php

namespace PhpObjectValues\App\ObjectValues\Traits;

trait Masked
{
    protected mixed $value;
    protected string $mask;

    public function masked(): string
    {
        $formatted = '';

        $digits = str_split((string) $this->value);
        $maskChars = str_split($this->mask);

        foreach ($maskChars as $char) {
            $formatted .= ($char == '#')
                ? array_shift($digits)
                : $char;
        }

        return $formatted;
    }

    public function setMask(string $mask): void
    {
        $this->mask = $mask;
    }
}
