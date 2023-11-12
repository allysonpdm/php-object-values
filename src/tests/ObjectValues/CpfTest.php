<?php

namespace Tests\Unit\ObjectValues;

use PhpObjectValues\App\ObjectValues\Cpf;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
#use Tests\TestCase;

class CpfTest extends TestCase
{
    public $cpfValid = ['sanitized' => '67682574046', 'masked' => '676.825.740-46'];
    public $cpfInvalid = ['sanitized' => '52998224724', 'masked' => '529.982.247-24'];

    public function test_valid_cpf_without_mask()
    {
        $cpf = new Cpf($this->cpfValid['sanitized']);

        $this->assertEquals($this->cpfValid['masked'], $cpf->masked());
        $this->assertEquals($this->cpfValid['sanitized'], $cpf->getValue());
        $this->assertEquals($this->cpfValid['sanitized'], (string) $cpf);
    }

    public function test_valid_cpf_with_mask()
    {
        $cpf = new Cpf($this->cpfValid['masked']);

        $this->assertEquals($this->cpfValid['masked'], $cpf->masked());
        $this->assertEquals($this->cpfValid['sanitized'], $cpf->getValue());
        $this->assertEquals($this->cpfValid['sanitized'], (string) $cpf);
    }

    public function test_invalid_cpf_without_mask()
    {
        $this->expectException(InvalidArgumentException::class);
        $cpf = new Cpf($this->cpfInvalid['sanitized']);
    }

    public function test_invalid_cpf_with_mask()
    {
        $this->expectException(InvalidArgumentException::class);
        $cpf = new Cpf($this->cpfInvalid['masked']);
    }

    public function test_sanitized_value()
    {
        $cpf = new Cpf($this->cpfValid['masked']);

        $this->assertEquals($this->cpfValid['sanitized'], $cpf->sanitized());
    }

    public function test_set_regex()
    {
        $cpf = new Cpf($this->cpfValid['masked']);
        $cpf->setRegex('[0-9]');

        $this->assertEquals('', $cpf->sanitized());
    }
}
