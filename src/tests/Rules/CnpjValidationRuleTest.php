<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;
use PhpObjectValues\App\Rules\CnpjValidationRule;

class CnpjValidationRuleTest extends TestCase
{
    public $cnpjValid = ['sanitized' => '50748961000157', 'masked' => '50.748.961/0001-57'];
    public $cnpjInvalid = ['sanitized' => '50748961000153', 'masked' => '50.748.961/0001-53'];

    public function test_cnpj_validation_rule()
    {
        $this->assertTrue(CnpjValidationRule::isValid($this->cnpjValid['masked']));
        $this->assertFalse(CnpjValidationRule::isValid($this->cnpjInvalid['masked']));
        $this->assertEquals('O :attribute não é válido.', CnpjValidationRule::$message);
    }

    /**
     * Test if the CNPJ is valid with mask.
     *
     * @return void
     */
    public function test_valid_cnpj_with_mask()
    {
        $result = CnpjValidationRule::isValid($this->cnpjValid['masked']);

        $this->assertTrue($result);
    }

    /**
     * Test if the CNPJ is valid without mask.
     *
     * @return void
     */
    public function test_valid_cnpj_without_mask()
    {
        $result = CnpjValidationRule::isValid($this->cnpjValid['sanitized']);

        $this->assertTrue($result);
    }

    /**
     * Test if the CNPJ with mask is invalid.
     *
     * @return void
     */
    public function test_invalid_cnpj_with_mask()
    {
        $result = CnpjValidationRule::isValid($this->cnpjInvalid['masked']);

        $this->assertFalse($result);
    }

    /**
     * Test if the CNPJ without mask is invalid.
     *
     * @return void
     */
    public function test_invalid_cnpj_without_mask()
    {
        $result = CnpjValidationRule::isValid($this->cnpjInvalid['sanitized']);

        $this->assertFalse($result);
    }

    /**
     * Test the error message.
     *
     * @return void
     */
    public function test_error_message()
    {
        $this->assertEquals('O :attribute não é válido.', CnpjValidationRule::$message);
    }

    /**
     * Test if CNPJ is empty.
     *
     * @return void
     */
    public function test_empty_cnpj()
    {
        $result =  CnpjValidationRule::isValid('');

        $this->assertFalse($result);
    }
}
