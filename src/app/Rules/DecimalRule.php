<?php

namespace App\Rules;

use App\Rules\Contracts\StaticValidator;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use InvalidArgumentException;

class DecimalRule implements ValidationRule, StaticValidator
{
    public static string $message = 'O :attribute não é válido.';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

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

    public static function isValid(mixed $value = null): bool
    {
        return is_numeric($value) &&
            (is_float($value) || is_integer($value));
    }
}
