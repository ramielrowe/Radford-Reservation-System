<?php

require_once 'PHPUnit/Autoload.php';


class TestCasePagesTest extends PHPUnit_Framework_TestCase{

	public static function setUpBeforeClass()
    {
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '/config.php';
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/functions.php';
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '/dbTestSetup.php';
		
		session_start();
    }
	
	public static function tearDownAfterClass()
    {
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '/dbTestTeardown.php';
    }
	
	public function testGetHomepage()
	{
	
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/home.php';

$expectedPage = "
	<center>
	
		<center><h3>Office Hours</h3></center>
		<table class=\"pickuptimes\">
			<tr>
				<td class=\"header\">Monday</td>
				<td class=\"header\">Tuesday</td>
				<td class=\"header\">Wednesday</td>
				<td class=\"header\">Thursday</td>
				<td class=\"header\">Friday</td>
			</tr>
			<tr>
				<td class=\"centeredcellbold\">3pm-5:30pm</td>
				<td class=\"centeredcellbold\">10am-12pm</td>
				<td class=\"centeredcellbold\">1pm-5:30pm</td>
				<td class=\"centeredcellbold\">8:30am-10am</td>
				<td class=\"centeredcellbold\">3pm-5pm</td>
			</tr>
			<tr>
				<td class=\"centeredcellbold\">-</td>
				<td class=\"centeredcellbold\">3:30pm-5:30pm</td>
				<td class=\"centeredcellbold\">-</td>
				<td class=\"centeredcellbold\">3:30pm-5:30pm</td>
				<td class=\"centeredcellbold\">-</td>
			</tr>

		</table>
		
		<h3>Your Equipment</h3>
		
		<table class=\"myequip\">
		
			<tr>
		
				<td class=\"header\">Equipment Name</td>
				<td class=\"header\">Status</td>
				<td class=\"header\">Check-out Date</td>
				<td class=\"header\">Due Date</td>
				<td class=\"header\">-</td>
			
			</tr>
			
			
	
		</table>
	
	</center>";
	
		$this->assertNotNull($pageData);
		$this->assertXmlStringEqualsXmlString($expectedPage, $pageData, "Actual page data not equal to expected.");
	
	}
	
}
?>