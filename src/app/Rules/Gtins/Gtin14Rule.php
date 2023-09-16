<?php

namespace App\Rules\Gtins;

use Illuminate\Contracts\Validation\Rule;

class Gtin14Rule implements Rule
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
        $value = (string) $value;

        if (!preg_match('/^\d{14}$/', $value)) {
            return false;
        }

        $digits = str_split($value);

        // Calculate the check digit
        $checkDigit = 0;
        for ($i = 0; $i < 13; $i += 2) {
            $checkDigit += (int) $digits[$i];
        }
        for ($i = 1; $i < 13; $i += 2) {
            $checkDigit += (int) $digits[$i] * 3;
        }
        $checkDigit = (10 - ($checkDigit % 10)) % 10;

        return $checkDigit === (int) $digits[13];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O código GTIN-14 informado não é válido.';
    }
}
