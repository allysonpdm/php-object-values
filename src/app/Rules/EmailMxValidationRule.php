<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailMxValidationRule implements ValidationRule
{
    public static string $message = 'O domínio do e-mail não possui um servidor MX válido.';

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!self::isValid($value)){
            $fail(self::$message);
        }
    }

    public static function isValid(?string $value = null): bool
    {
        if(empty($value)){
            return false;
        }

        $parts = explode('@', $value);

        if (count($parts) !== 2) {
            return false;
        }

        $domain = trim($parts[1]);

        return checkdnsrr($domain, 'MX');
    }

}
