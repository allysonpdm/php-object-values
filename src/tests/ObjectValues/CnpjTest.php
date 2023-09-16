<?php

namespace Tests\Unit\ObjectValues;

use App\ObjectValues\Cnpj;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
#use Tests\TestCase;

class CnpjTest extends TestCase
{
    public $cnpjValid = ['sanitized' => '50748961000157', 'masked' => '50.748.961/0001-57'];
    public $cnpjInvalid = ['sanitized' => '50748961000153', 'masked' => '50.748.961/0001-53'];

    public function test_valid_cnpj_without_mask()
    {
        $cnpj = new Cnpj($this->cnpjValid['sanitized']);

        $this->assertEquals($this->cnpjValid['masked'], $cnpj->masked());
        $this->assertEquals($this->cnpjValid['sanitized'], $cnpj->getValue());
        $this->assertEquals($this->cnpjValid['sanitized'], (string) $cnpj);
    }

    public function test_valid_cnpj_with_mask()
    {
        $cnpj = new Cnpj($this->cnpjValid['masked']);

        $this->assertEquals($this->cnpjValid['masked'], $cnpj->masked());
        $this->assertEquals($this->cnpjValid['sanitized'], $cnpj->getValue());
        $this->assertEquals($this->cnpjValid['sanitized'], (string) $cnpj);
    }

    public function test_invalid_cnpj_without_mask()
    {
        $this->expectException(InvalidArgumentException::class);
        new Cnpj($this->cnpjInvalid['sanitized']);
    }

    public function test_invalid_cnpj_with_mask()
    {
        $this->expectException(InvalidArgumentException::class);
        new Cnpj($this->cnpjInvalid['masked']);
    }

    public function test_null_cnpj()
    {
        $this->expectException(InvalidArgumentException::class);
        new Cnpj(null);
    }

    public function test_empty_string_cnpj()
    {
        $this->expectException(InvalidArgumentException::class);
        new Cnpj('');
    }

    public function test_sanitized_value()
    {
        $cnpj = new Cnpj($this->cnpjValid['masked']);

        $this->assertEquals($this->cnpjValid['sanitized'], $cnpj->sanitized());
    }

    public function test_set_regex()
    {
        $cnpj = new Cnpj($this->cnpjValid['masked']);
        $cnpj->setRegex('[0-9]');

        $this->assertEquals('', $cnpj->sanitized());
    }
}
