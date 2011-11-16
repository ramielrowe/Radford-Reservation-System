<?php

require_once 'ResSysDBTest.php';

class TestCaseReservationTest extends ResSysDBTest{

	public function testMakeReservationPage(){
	
		$this->setSessionUserAdmin();
		$_GET['equipid'] = 1;
		$_GET['pageid'] = "reservation";
		
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/reservation.php';
		
		$expectedPage = "<center><h3>Make Reservation</h3></center>
		
		<script type=\"text/javascript\">
			function checkDate(){

				if(document.reservation.startdate.value == \"".getCurrentMySQLDate()."\"){

					return confirm(\"Reservations placed on the same day as they are created cannot be guaranteed to be ready for their start date. By continuing you are acknowledging that. Would you like to continue?\");

				}else{
					return true;
				}

			}
		</script>

		<form name=\"reservation\" action=\"./index.php?pageid=finishres\" method=\"POST\" onsubmit=\"return checkDate();\">
		
		<table class=\"reservation\">
		
			<tr>
			
				<td colspan=4 class=\"header\">Reserve the All Users1<input type=\"hidden\" name=\"equip_id\" value=\"1\"></td>
			
			</tr>
		
			<tr>
			
				<td class=\"centeredcellbold\">Date (YYYY-MM-DD)</td>
				<td class=\"centeredcell\"><script language=\"JavaScript\" id=\"jscal1x\">
	var cal1x = new CalendarPopup(\"testdiv1\");
	</script><input type=\"text\" name=\"startdate\" id=\"startdate\" onClick=\"cal1x.select(document.forms[0].startdate,'anchor1x','yyyy-MM-dd'); return false;\"><a style=\"visibility:hidden;\" name=\"anchor1x\" id=\"anchor1x\">a</a></td>
				<td class=\"centeredcellbold\">Length</td>
				<td class=\"centeredcell\">
					<select name=\"length\">
						<option value=\"1\">1</option>
						<option value=\"2\">2</option>
						<option value=\"3\">3</option>
						<option value=\"4\">4</option>
						<option value=\"5\">5</option>
					</select>
				</td>
		
			</tr>

			<tr>
			
				<td colspan=1 class=\"centeredcellbold\">User Comment</th>
				<td class=\"centeredcell\" colspan=3><textarea rows=5 cols=45 name=\"usercomment\"></textarea></td>
			
			</tr>
				
				<tr>
				
					<td colspan=4 class=\"centeredcell\"><input type=\"submit\" value=\"Reserve\"></td>
		
				</tr>
				
			</table>
			</form></div><DIV ID=\"testdiv1\" STYLE=\"position:absolute;visibility:hidden;background-color:white;\"></DIV>";
			
			$this->assertPageEquals($expectedPage, $pageData);
	
	}
	
	public function testMakeReservationPageWithWarnedUser(){
	
		$this->setSessionUserThreeWarnings();
		$_GET['equipid'] = 1;
		$_GET['pageid'] = "reservation";
		
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/reservation.php';
		
		$expectedPage = "<center><h3><font color=\"#FF0000\">Error: You have recieved 3 or more warnings.</font></h3>To reserve equipment please contact an admin: <br><br>Test Admin -- ".DBTestUtil::getTestEmail()."<br /></center>";
		
		$this->assertPageEquals($expectedPage, $pageData);
	
	}
	
}

?>