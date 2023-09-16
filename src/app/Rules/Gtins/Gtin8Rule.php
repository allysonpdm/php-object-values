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
        // Verifica se o valor informado é uma string numérica com exatamente 8 dígitos
        if (!is_string($value) || !ctype_digit($value) || strlen($value) !== 8) {
            return false;
        }

        // Calcula o dígito verificador (DV)
        $checkDigit = $this->calculateCheckDigit(substr($value, 0, 7));

        // Verifica se o DV calculado é igual ao DV informado no código GTIN-8
        return $checkDigit === $value[7];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O código GTIN-8 informado não é válido.';
    }

    /**
     * Calcula o dígito verificador (DV) de um código GTIN-8.
     *
     * @param string $digits Os 7 primeiros dígitos do código GTIN-8.
     * @return string O dígito verificador (DV) calculado.
     */
    private function calculateCheckDigit(string $digits): string
    {
        $multipliers = [3, 1, 3, 1, 3, 1, 3]; // Padrão para cálculo do DV do GTIN-8

        $sum = 0;
        for ($i = 0; $i < 7; $i++) {
            $sum += $digits[$i] * $multipliers[$i];
        }

        $remainder = $sum % 10;
        if ($remainder === 0) {
            return '0';
        }

        return (string) (10 - $remainder);
    }
}
