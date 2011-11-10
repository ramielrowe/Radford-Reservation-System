<?php

require_once dirname(__FILE__).DIRECTORY_SEPARATOR."../TestingClass.php";

class TestCaseExample extends PHPUnit_Framework_TestCase
{		
	public function testDoSomething()
	{
		$myClass = new TestingClass();	
		$result = $myClass->doSomething("something");
		
		$this->assertEquals($result, "something");
	}
	
	public function testDoSomethingElse()
	{
		$myClass = new TestingClass();	
		$result = $myClass->doSomethingElse(2, 2);
		
		$this->assertEquals($result, 4);
	}
}
?>