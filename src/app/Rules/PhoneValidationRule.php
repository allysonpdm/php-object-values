<?php

namespace PhpObjectValues\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneValidationRule implements ValidationRule
{
    public static string $message = 'O :attribute não é um número de telefone válido.';

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!self::isValid($value)) {
            $fail(self::$message);
        }
    }

    public static function isValid(?string $phone = null): bool
    {
        if (empty($phone)) {
            return false;
        }

        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (!preg_match('/^\d{10,15}$/', $phone)) {
            return false;
        }

        return true;
    }
}
