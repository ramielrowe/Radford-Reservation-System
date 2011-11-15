<?php

require_once 'ResSysDBTest.php';

class TestCaseHomepageTest extends ResSysDBTest{
	
	public function testGetHomepage(){
	
		$this->setSessionUserAdmin();
		
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/home.php';

		$expectedPage = "
			<center>
				<h3>System Messages</h3>
				<div class=\"messageoutter\"><div class=\"priority2message\">This is a high priority message.</div></div>
				<div class=\"messageoutter\"><div class=\"priority1message\">This is a low priority message.</div></div>
				<h3>Office Hours</h3>
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
					
					
				
			<tr>

				<td class=\"myequipApproved\">All Users1</td>
				<td class=\"myequipApproved\">Approved</td>
				<td class=\"myequipApproved\">".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(), 10)."</td>
				<td class=\"myequipApproved\">".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(), 5)."</td>
				<td class=\"myequipApproved\"><a href=\"./index.php?pageid=viewreservation&resid=1\">View</a></td>

			</tr>
			<tr>

				<td class=\"myequipDenied\">All Users2</td>
				<td class=\"myequipDenied\">Denied</td>
				<td class=\"myequipDenied\">".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(), 12)."</td>
				<td class=\"myequipDenied\">".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(), 11)."</td>
				<td class=\"myequipDenied\"><a href=\"./index.php?pageid=viewreservation&resid=2\">View</a></td>

			</tr>
			
				</table>
			
			</center>";
	
		$this->assertPageEquals($expectedPage, $pageData);
	
	}
	
}
?>