<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;
use App\Rules\CpfValidationRule;

class CpfValidationRuleTest extends TestCase
{
    public $cpfValid = ['sanitized' => '67682574046', 'masked' => '676.825.740-46'];
    public $cpfInvalid = ['sanitized' => '52998224724', 'masked' => '529.982.247-24'];

    public function test_cpf_validation_rule()
    {
        $this->assertTrue(CpfValidationRule::isValid($this->cpfValid['masked']));
        $this->assertFalse(CpfValidationRule::isValid($this->cpfInvalid['masked']));
        $this->assertEquals('O :attribute não é válido.', CpfValidationRule::$message);
    }

    /**
     * Test if the CPF is valid with mask.
     *
     * @return void
     */
    public function test_valid_cpf_with_mask()
    {
        $result = CpfValidationRule::isValid($this->cpfValid['masked']);

        $this->assertTrue($result);
    }

    /**
     * Test if the CPF is valid without mask.
     *
     * @return void
     */
    public function test_valid_cpf_without_mask()
    {
        $result = CpfValidationRule::isValid($this->cpfValid['sanitized']);

        $this->assertTrue($result);
    }

    /**
     * Test if the CPF with mask is invalid.
     *
     * @return void
     */
    public function test_invalid_cpf_with_mask()
    {
        $result = CpfValidationRule::isValid($this->cpfInvalid['masked']);

        $this->assertFalse($result);
    }

    /**
     * Test if the CPF without mask is invalid.
     *
     * @return void
     */
    public function test_invalid_cpf_without_mask()
    {
        $result = CpfValidationRule::isValid($this->cpfInvalid['sanitized']);

        $this->assertFalse($result);
    }

    /**
     * Test the error message.
     *
     * @return void
     */
    public function test_error_message()
    {
        $this->assertEquals('O :attribute não é válido.', CpfValidationRule::$message);
    }

    /**
     * Test if CPF is empty.
     *
     * @return void
     */
    public function test_empty_cpf()
    {
        $result = CpfValidationRule::isValid('');

        $this->assertFalse($result);
    }
}
