<?php

namespace PhpObjectValues\App\Rules\Contracts;

interface StaticValidator
{
    public static function isValid(): bool;
}