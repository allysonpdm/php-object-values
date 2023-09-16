<?php

namespace Tests\Unit\ObjectValues;

use App\ObjectValues\Email;
use InvalidArgumentException;
#use Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * @test
     * @dataProvider validEmailProvider
     */
    public function test_valid_email($email, $obfuscated)
    {
        $email = new Email($email);
        $this->assertEquals($email, $email->getValue());
        $this->assertEquals($obfuscated, $email->obfuscated(3,4));
        $this->assertEquals(Str::lower($email), (string) $email);
    }

    /**
     * @test
     * @dataProvider invalidEmailProvider
     */
    public function test_invalid_email($email)
    {
        $this->expectException(InvalidArgumentException::class);
        $email = new Email($email);
    }

    /**
     * @test
     * @dataProvider invalidEmailProvider
     */
    public function test_email_validation_error_message($email)
    {
        $this->expectExceptionMessage('O e-mail não é válido.');

        $email = new Email($email);
    }

    public static function validEmailProvider()
    {
        return [
            ['john.doe@example.com', 'joh*************.com'],
            ['test@example.com', 'tes*********.com'],
            ['john@gmail.com', 'joh*******.com'],
        ];
    }

    public static function invalidEmailProvider()
    {
        return [
            ['john.doe@example'], // missing TLD
            ['jane@localhost'], // localhost is not valid
        ];
    }
}
