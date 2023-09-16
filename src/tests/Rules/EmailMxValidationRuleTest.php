<?php

namespace Tests\Unit\Rules;

use App\Rules\EmailMxValidationRule;
use PHPUnit\Framework\TestCase;

class EmailMxValidationRuleTest extends TestCase
{
    /**
     * @test
     * @dataProvider validEmailProvider
     */
    public function passes_with_valid_emails(string $email)
    {
        $result = EmailMxValidationRule::isValid($email);
        $this->assertTrue($result);
    }

    /**
     * @test
     * @dataProvider invalidEmailProvider
     */
    public function fails_with_invalid_emails(string $email)
    {
        $result = EmailMxValidationRule::isValid($email);
        $this->assertFalse($result);
    }

    public static function validEmailProvider()
    {
        return [
            ['john.doe@example.com'],
            ['test@example.com'],
            ['john@gmail.com'],
        ];
    }

    public static function invalidEmailProvider()
    {
        return [
            ['john.doe@example'], // missing TLD
            ['jane@localhost'], // localhost is not valid
            ['john@doesnotexistexample.com'], // domain does not exist
        ];
    }
}
