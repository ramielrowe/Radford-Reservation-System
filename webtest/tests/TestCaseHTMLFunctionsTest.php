<?php

require_once 'PHPUnit/Autoload.php';


class TestCaseHTMLFunctionsTest extends PHPUnit_Framework_TestCase{

	public static function setUpBeforeClass()
    {
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '/config.php';
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/functions.php';
		
		session_start();
    }
	
	public function testGetEquipmentTypesDropDown()
	{
	
		$formName = "equips";
		$formSize = "1";
		$expectedHTML = "<select name=\"".$formName."\" size=\"".$formSize."\">";
		$expectedHTML = $expectedHTML . "<option value=\"Geology\">Geology</option>";
		$expectedHTML = $expectedHTML . "<option value=\"Geospatial\">Geospatial</option>";
		$expectedHTML = $expectedHTML . "<option value=\"Physics\">Physics</option>";
		$expectedHTML = $expectedHTML . "<option value=\"Anthropology\">Anthropology</option>";
		$expectedHTML = $expectedHTML . "<option value=\"Forensics Institute\">Forensics Institute</option></select>";
	
		$actualHTML = getEquipmentTypesDropDown($formName, $formSize);
		
		$this->assertEquals($expectedHTML, $actualHTML, "Equipment form improperly generated.");
	
	}
	
	public function testGetEquipmentTypesDropDownShouldSelectPhysics()
	{
	
		$formName = "equips";
		$formSize = "1";
		$expectedHTML = "<select name=\"".$formName."\" size=\"".$formSize."\">";
		$expectedHTML = $expectedHTML . "<option value=\"Geology\">Geology</option>";
		$expectedHTML = $expectedHTML . "<option value=\"Geospatial\">Geospatial</option>";
		$expectedHTML = $expectedHTML . "<option value=\"Physics\" selected=\"selected\">Physics</option>";
		$expectedHTML = $expectedHTML . "<option value=\"Anthropology\">Anthropology</option>";
		$expectedHTML = $expectedHTML . "<option value=\"Forensics Institute\">Forensics Institute</option></select>";
	
		$actualHTML = getEquipmentTypesDropDownSelected($formName, $formSize, 'Physics');
		
		$this->assertEquals($expectedHTML, $actualHTML, "Equipment form improperly generated.");
	
	}
	
}
?>