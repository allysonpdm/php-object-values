<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DetranPlateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $patterns = [
            '/^[A-Z]{3}-\d{4}$/',
            '/^[A-Z]{3}[1-9][A-Z]\d{2}$/',
            '/^[A-Z]{3}-[1-9][A-Z]\d{2}$/',
            '/^[A-Z]{3}[1-9][A-Z]{1}\d{2}$/',
            '/^[A-Z]{3}[1-9][A-Z]{1}\d{1}-\d{1}$/',
            '/^[A-Z]{4}[1-9][A-Z]?\d{1}$/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A placa informada não é válida.';
    }
}
