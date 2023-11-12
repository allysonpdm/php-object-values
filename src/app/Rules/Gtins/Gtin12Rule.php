<?php

namespace PhpObjectValues\App\Rules\Gtins;

use Illuminate\Contracts\Validation\Rule;

class Gtin12Rule implements Rule
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
        $pattern = '/^\d{12}$/';
        if (!preg_match($pattern, $value)) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i < 11; $i++) {
            $sum += ((int) $value[$i]) * (($i % 2 === 0) ? 3 : 1);
        }

        $checkDigit = (10 - ($sum % 10)) % 10;

        return $checkDigit === (int) $value[11];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O código GTIN-12 informado é inválido.';
    }
}
