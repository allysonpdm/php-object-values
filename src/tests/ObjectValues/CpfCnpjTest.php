<?php

namespace Tests\Unit\ObjectValues;

use PhpObjectValues\App\ObjectValues\CpfCnpj;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

#use Tests\TestCase;

class CpfCnpjTest extends TestCase
{
    public $cnpjValid = ['sanitized' => '50748961000157', 'masked' => '50.748.961/0001-57'];
    public $cnpjInvalid = ['sanitized' => '50748961000153', 'masked' => '50.748.961/0001-53'];
    public $cpfValid = ['sanitized' => '67682574046', 'masked' => '676.825.740-46'];
    public $cpfInvalid = ['sanitized' => '52998224724', 'masked' => '529.982.247-24'];

    public function test_valid_cpf_without_mask()
    {
        $cpf = new CpfCnpj($this->cpfValid['sanitized']);

        $this->assertEquals($this->cpfValid['masked'], $cpf->masked());
        $this->assertEquals($this->cpfValid['sanitized'], $cpf->getValue());
        $this->assertEquals($this->cpfValid['sanitized'], (string) $cpf);
        $this->assertTrue($cpf->isCpf());
        $this->assertFalse($cpf->isCnpj());
    }

    public function test_valid_cpf_with_mask()
    {
        $cpf = new CpfCnpj($this->cpfValid['masked']);

        $this->assertEquals($this->cpfValid['masked'], $cpf->masked());
        $this->assertEquals($this->cpfValid['sanitized'], $cpf->getValue());
        $this->assertEquals($this->cpfValid['sanitized'], (string) $cpf);
        $this->assertTrue($cpf->isCpf());
        $this->assertFalse($cpf->isCnpj());
    }

    public function test_invalid_cpf_without_mask()
    {
        $this->expectException(InvalidArgumentException::class);
        new CpfCnpj($this->cpfInvalid['sanitized']);
    }

    public function test_invalid_cpf_with_mask()
    {
        $this->expectException(InvalidArgumentException::class);
        new CpfCnpj($this->cpfInvalid['masked']);
    }

    public function test_valid_cnpj_without_mask()
    {
        $cnpj = new CpfCnpj($this->cnpjValid['sanitized']);

        $this->assertEquals($this->cnpjValid['masked'], $cnpj->masked());
        $this->assertEquals($this->cnpjValid['sanitized'], $cnpj->getValue());
        $this->assertEquals($this->cnpjValid['sanitized'], (string) $cnpj);
        $this->assertFalse($cnpj->isCpf());
        $this->assertTrue($cnpj->isCnpj());
    }

    public function test_valid_cnpj_with_mask()
    {
        $cnpj = new CpfCnpj($this->cnpjValid['masked']);

        $this->assertEquals($this->cnpjValid['masked'], $cnpj->masked());
        $this->assertEquals($this->cnpjValid['sanitized'], $cnpj->getValue());
        $this->assertEquals($this->cnpjValid['sanitized'], (string) $cnpj);
        $this->assertFalse($cnpj->isCpf());
        $this->assertTrue($cnpj->isCnpj());
    }

    public function test_invalid_cnpj_without_mask()
    {
        $this->expectException(InvalidArgumentException::class);
        new CpfCnpj($this->cnpjInvalid['sanitized']);
    }

    public function test_invalid_cnpj_with_mask()
    {
        $this->expectException(InvalidArgumentException::class);
        new CpfCnpj($this->cnpjInvalid['masked']);
    }

    public function test_empty_string_cnpj()
    {
        $this->expectException(InvalidArgumentException::class);
        new CpfCnpj('');
    }

    public function test_set_regex()
    {
        $cnpj = new CpfCnpj($this->cnpjValid['masked']);
        $cnpj->setRegex('[0-9]');

        $this->assertEquals('', $cnpj->sanitized());
    }
}
