<?php

namespace App\Rules\Gtins;

use Illuminate\Contracts\Validation\Rule;

class Gtin13Rule implements Rule
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
        $length = strlen($value);

        // Verifica se o valor tem 13 caracteres
        if ($length !== 13) {
            return false;
        }

        // Verifica se o valor contém apenas números
        if (!ctype_digit($value)) {
            return false;
        }

        // Calcula o dígito verificador usando o algoritmo de Luhn
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $digit = (int) $value[$i];
            $sum += ($i % 2 === 0) ? $digit * 1 : $digit * 3;
        }
        $checkDigit = (10 - ($sum % 10)) % 10;

        // Verifica se o dígito verificador está correto
        if ($checkDigit !== (int) $value[12]) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O valor informado não é um código GTIN-13 válido.';
    }
}
