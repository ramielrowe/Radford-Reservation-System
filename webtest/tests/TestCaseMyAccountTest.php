<?php

require_once 'ResSysDBTest.php';

class TestCaseMyAccountTest extends ResSysDBTest{

	public function testMyAccountPageForUserWithWarnings(){
	
		$this->setSessionUserAdmin();
		
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/myaccount.php';
	
		$expectedPage = "<center><h3>My Account</h3></center>
			<table class=\"myaccount\">
				<tr>
					<td colspan=4 class=\"header\">Edit User Information</td>
				</tr>
				<tr>
					<td class=\"centeredcellbold\">Username</td>
					<td colspan=3 class=\"centeredcell\">Admin</td>
				</tr>
				<tr>
					<td class=\"centeredcellbold\">Name</th>
					<td colspan=3 class=\"centeredcell\">Test Admin</td>
				</tr>
				<tr>
					<td class=\"centeredcellbold\">Change Password</td>
					<td class=\"centeredcellbold\">Current Password</td>
					<td class=\"centeredcellbold\">New Password</td>
					<td class=\"centeredcellbold\">Confirm Password</td>
				</tr>
				<tr>
					<form action=\"./index.php?pageid=savepassword\" method=\"POST\"><td class=\"centeredcellbold\"><input type=\"submit\" value=\"Save Password\"></td>
					<td class=\"centeredcell\"><input type=\"password\" name=\"curpass\"></td>
					<td class=\"centeredcell\"><input type=\"password\" name=\"newpass\"></th>
					<td class=\"centeredcell\"><input type=\"password\" name=\"confpass\"></td></form>
				</tr>
				<tr>
					<form action=\"./index.php?pageid=saveemail\" method=\"POST\">
					<td colspan=1 class=\"centeredcellbold\">Email</th><td colspan=3 class=\"centeredcell\"><input type=\"text\" name=\"email\" size=30 value=\"".DBTestUtil::getTestEmail()."\"><input type=\"submit\" value=\"Save Email\"></td></form>
				</tr>
				<tr>
					<td colspan=1 class=\"centeredcellbold\">Warnings</th>
					<td class=\"centeredcellbold\" colspan=3><a href=\"./index.php?pageid=viewmywarnings\">0(0)</a></td>
				</tr>
					
			</table>";
	
		$this->assertPageEquals($expectedPage, $pageData);
	
	}
	public function testMyAccountPageForUserWithoutWarnings(){
	
		$this->setSessionUserNormal();
		
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/myaccount.php';
	
		$expectedPage = "<center><h3>My Account</h3></center>
			<table class=\"myaccount\">
				<tr>
					<td colspan=4 class=\"header\">Edit User Information</td>
				</tr>
				<tr>
					<td class=\"centeredcellbold\">Username</td>
					<td colspan=3 class=\"centeredcell\">User</td>
				</tr>
				<tr>
					<td class=\"centeredcellbold\">Name</th>
					<td colspan=3 class=\"centeredcell\">Test User</td>
				</tr>
				<tr>
					<td class=\"centeredcellbold\">Change Password</td>
					<td class=\"centeredcellbold\">Current Password</td>
					<td class=\"centeredcellbold\">New Password</td>
					<td class=\"centeredcellbold\">Confirm Password</td>
				</tr>
				<tr>
					<form action=\"./index.php?pageid=savepassword\" method=\"POST\"><td class=\"centeredcellbold\"><input type=\"submit\" value=\"Save Password\"></td>
					<td class=\"centeredcell\"><input type=\"password\" name=\"curpass\"></td>
					<td class=\"centeredcell\"><input type=\"password\" name=\"newpass\"></th>
					<td class=\"centeredcell\"><input type=\"password\" name=\"confpass\"></td></form>
				</tr>
				<tr>
					<form action=\"./index.php?pageid=saveemail\" method=\"POST\">
					<td colspan=1 class=\"centeredcellbold\">Email</th><td colspan=3 class=\"centeredcell\"><input type=\"text\" name=\"email\" size=30 value=\"".DBTestUtil::getTestEmail()."\"><input type=\"submit\" value=\"Save Email\"></td></form>
				</tr>
				<tr>
					<td colspan=1 class=\"centeredcellbold\">Warnings</th>
					<td class=\"centeredcellbold\" colspan=3><a href=\"./index.php?pageid=viewmywarnings\">1(3)</a></td>
				</tr>
					
			</table>";
	
		$this->assertPageEquals($expectedPage, $pageData);
	
	}

}

?>