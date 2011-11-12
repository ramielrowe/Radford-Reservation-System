<?php

//require_once 'PHPUnit.php';
//require_once 'PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Autoload.php';


class TestCaseFunctionsTest extends PHPUnit_Framework_TestCase{

	public static function setUpBeforeClass()
    {
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '/config.php';
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/functions.php';
		
		session_start();
    }
	
	public function testGetConfigVar(){
	
		$expectedLocation = "http://www.domain.com/res/";
		
		$actualLocation = getConfigVar('location');
		
		$this->assertEquals($expectedLocation, $actualLocation, "getConfigVar(variable_name) returned incorrect location");
	
	}

	public function testSetSessionVariableShouldSetValue()
	{
		$variableName = "varTestSet";
		$expectedValue = "TestValue";
		
		setSessionVariable($variableName, $expectedValue);
		
		$this->assertTrue(isset($_SESSION[getConfigVar('location').'-'.$variableName]), 
			"setSessionVariable(variable_name, value) did not set session variable.");
		$this->assertEquals($expectedValue, $_SESSION[getConfigVar('location').'-'.$variableName],
			"setSessionVariable(variable_name, value) improperly set value.");
			
	}

	public function testGetSessionVariableShouldGetValue()
	{
		$variableName = "varTestSet";
		$expectedValue = "TestValue2";
		
		setSessionVariable($variableName, $expectedValue);
		$actualValue = getSessionVariable($variableName);
		
		$this->assertEquals($expectedValue, $actualValue,
			"getSessionVariable(variable_name, value) got incorrect value.");
			
	}

	public function testIssetSessionVariableShouldReturnFalse()
	{
		$variableName = "thisShouldBeUnset";
		$actualValue = issetSessionVariable($variableName);
		
		$this->assertFalse($actualValue,
			"issetSessionVariable(variable_name) returned true for unset variable.");
			
	}

	public function testIssetSessionVariableShouldReturnTrue()
	{
		$variableName = "thisShouldBeSet";
		setSessionVariable($variableName, "testtesttest");
	
		$actualValue = issetSessionVariable('thisShouldBeSet');
		
		$this->assertTrue($actualValue,
			"issetSessionVariable(variable_name) returned false for set variable.");
			
	}
	
	public function testEncryptDecrypt()
	{
	
		$unencryptedText = "TestTestTest";
		
		$encryptedText = encrypt($unencryptedText);
		$decryptedText = decrypt($encryptedText);
		
		$this->assertNotEquals($unencryptedText, $encryptedText,
			"Encrypt(text) returned the text as it took in.");
		
		$this->assertEquals($unencryptedText, $decryptedText,
			"Encrypt(text)/Decrypt(text) failed to properly encrypt/decrypt text.");
	}
}
?>
