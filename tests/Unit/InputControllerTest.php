<?php

class InputControllerTest extends \PHPUnit\Framework\TestCase // Use PHPUnit Test Class
{
    public function testAllowTextMoreThan20Characters() // This will test will allow for more than 20 characters in a text value
    {
        require_once __DIR__.'/../../classes/InputProcessor.php';
        $expectedValue = "LongerThan20Characters";
        $result = InputProcessor::processString($expectedValue,100);

        $this->assertEquals($expectedValue,$result['value']); // Return Unit Testing Result of true if the Input text is valid, false if not
    }

    public function testDenyTextMoreThan20Characters() // This will test will deny for more than 20 characters in a text value
    {
        require_once __DIR__.'/../../classes/InputProcessor.php';
        $expectedValue = "LongerThan20Characters";
        $result = InputProcessor::processString($expectedValue,20);

        $this->assertEquals($expectedValue,$result['value']); // Return Unit Testing Result of true if the Input text is valid, false if not
    }

    public function testInvalidEmail() // This will test will deny an invalid email, returning false if email is invalid
    {
        require_once __DIR__.'/../../classes/InputProcessor.php';
        $expectedValue = false;
        $result = InputProcessor::processEmail("johndoe.com")['valid'];

        $this->assertEquals($expectedValue,$result); // Return Unit Testing Result of true if the Input text is valid, false if not
    }

    public function testValidEmail() // This will test will allow a valid email, returning true if email is valid
    {
        require_once __DIR__.'/../../classes/InputProcessor.php';
        $expectedValue = true;
        $result = InputProcessor::processEmail("johndoe@email.com")['valid'];

        $this->assertEquals($expectedValue,$result); // Return Unit Testing Result of true if the Input text is valid, false if not
    }

    public function testVerifyMatchedPasswords() // This will test will allow a valid email, returning true if email is valid
    {
        require_once __DIR__.'/../../classes/InputProcessor.php';
        $expectedValue = true;
        $result = InputProcessor::processPassword("Password123","Password123")['valid'];

        $this->assertEquals($expectedValue,$result); // Return Unit Testing Result of true if the Passwords match, false if not
    }

    public function testVerifyErrorInMatchingPasswords() // This will test for matching passwords in the password verification process
    {
        require_once __DIR__.'/../../classes/InputProcessor.php';
        $expectedValue = '';
        $result = InputProcessor::processPassword("Password123","Password123")['error'];

        $this->assertEquals($expectedValue,$result); // Return Unit Testing Result of true if the Passwords match, false if not
    }
    
}

?>