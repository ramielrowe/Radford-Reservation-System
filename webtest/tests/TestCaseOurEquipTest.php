<?php

require_once 'ResSysDBTest.php';

class TestCaseOurEquipTest extends ResSysDBTest{

	public function testGetOurEquipForAdmin(){
	
		$this->setSessionUserAdmin();
		
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/ourequip.php';
	
		$expectedPage = "<center><h3>Our Equipment</h3></center>
		<center><b><a href=\"#Category 1\">Category 1</a> - <a href=\"#Category 2\">Category 2</a></b></center>
		<h3>Category 1</h3>
		<table class=\"ourequip\">
			<tr>
				<td width=\"40%\" class=\"header\" id=\"Category 1\">Equipment Name</th>
				<td width=\"15%\"  class=\"header\">--</th>
				<td width=\"25%\" class=\"header\">Status</th>
				<td width=\"20%\" class=\"header\">--</th>
			</tr>
			<tr>
				<td class=\"centeredcell\">All Users1</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=1\">More Info</a></td>
				<td class=\"centeredcell\">Available</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=reservation&equipid=1\">Reserve</a></td>
			</tr>
			<tr>
				<td class=\"centeredcell\">Only Mods</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=3\">More Info</a></td>
				<td class=\"centeredcell\">Available</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=reservation&equipid=3\">Reserve</a></td>
			</tr>
		</table>
		
		<h3>Category 2</h3>
		<table class=\"ourequip\">
			<tr>
				<td width=\"40%\" class=\"header\" id=\"Category 2\">Equipment Name</th>
				<td width=\"15%\"  class=\"header\">--</th>
				<td width=\"25%\" class=\"header\">Status</th>
				<td width=\"20%\" class=\"header\">--</th>
			</tr>
			<tr>
				<td class=\"centeredcell\">All Users2</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=2\">More Info</a></td>
				<td class=\"centeredcell\">Available</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=reservation&equipid=2\">Reserve</a></td>
			</tr>
			<tr>
				<td class=\"centeredcell\">Check Out From</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=4\">More Info</a></td>
				<td class=\"centeredcell\" colspan=2>Checkout from<br><a href=\"mailto:".DBTestUtil::getTestEmail()."\">Test Mod</a></td>
			</tr>
		</table>";
	
		$this->assertPageEquals($expectedPage, $pageData);
	
	}
	
	public function testGetOurEquipForMod(){
	
		$this->setSessionUserMod();
		
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/ourequip.php';
	
		$expectedPage = "<center><h3>Our Equipment</h3></center>
		<center><b><a href=\"#Category 1\">Category 1</a> - <a href=\"#Category 2\">Category 2</a></b></center>
		<h3>Category 1</h3>
		<table class=\"ourequip\">
			<tr>
				<td width=\"40%\" class=\"header\" id=\"Category 1\">Equipment Name</th>
				<td width=\"15%\"  class=\"header\">--</th>
				<td width=\"25%\" class=\"header\">Status</th>
				<td width=\"20%\" class=\"header\">--</th>
			</tr>
			<tr>
				<td class=\"centeredcell\">All Users1</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=1\">More Info</a></td>
				<td class=\"centeredcell\">Available</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=reservation&equipid=1\">Reserve</a></td>
			</tr>
			<tr>
				<td class=\"centeredcell\">Only Mods</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=3\">More Info</a></td>
				<td class=\"centeredcell\">Available</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=reservation&equipid=3\">Reserve</a></td>
			</tr>
		</table>
		
		<h3>Category 2</h3>
		<table class=\"ourequip\">
			<tr>
				<td width=\"40%\" class=\"header\" id=\"Category 2\">Equipment Name</th>
				<td width=\"15%\"  class=\"header\">--</th>
				<td width=\"25%\" class=\"header\">Status</th>
				<td width=\"20%\" class=\"header\">--</th>
			</tr>
			<tr>
				<td class=\"centeredcell\">All Users2</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=2\">More Info</a></td>
				<td class=\"centeredcell\">Available</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=reservation&equipid=2\">Reserve</a></td>
			</tr>
			<tr>
				<td class=\"centeredcell\">Check Out From</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=4\">More Info</a></td>
				<td class=\"centeredcell\" colspan=2>Checkout from<br><a href=\"mailto:".DBTestUtil::getTestEmail()."\">Test Mod</a></td>
			</tr>
		</table>";
	
		$this->assertPageEquals($expectedPage, $pageData);
	
	}
	
	public function testGetOurEquipForNormalUser(){
	
		$this->setSessionUserNormal();
		
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/ourequip.php';
	
		$expectedPage = "<center><h3>Our Equipment</h3></center>
		<center><b><a href=\"#Category 1\">Category 1</a> - <a href=\"#Category 2\">Category 2</a></b></center>
		<h3>Category 1</h3>
		<table class=\"ourequip\">
			<tr>
				<td width=\"40%\" class=\"header\" id=\"Category 1\">Equipment Name</th>
				<td width=\"15%\"  class=\"header\">--</th>
				<td width=\"25%\" class=\"header\">Status</th>
				<td width=\"20%\" class=\"header\">--</th>
			</tr>
			<tr>
				<td class=\"centeredcell\">All Users1</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=1\">More Info</a></td>
				<td class=\"centeredcell\">Available</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=reservation&equipid=1\">Reserve</a></td>
			</tr>
		</table>
		
		<h3>Category 2</h3>
		<table class=\"ourequip\">
			<tr>
				<td width=\"40%\" class=\"header\" id=\"Category 2\">Equipment Name</th>
				<td width=\"15%\"  class=\"header\">--</th>
				<td width=\"25%\" class=\"header\">Status</th>
				<td width=\"20%\" class=\"header\">--</th>
			</tr>
			<tr>
				<td class=\"centeredcell\">All Users2</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=2\">More Info</a></td>
				<td class=\"centeredcell\">Available</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=reservation&equipid=2\">Reserve</a></td>
			</tr>
			<tr>
				<td class=\"centeredcell\">Check Out From</td>
				<td class=\"centeredcell\"><a href=\"./index.php?pageid=moreinfo&equipid=4\">More Info</a></td>
				<td class=\"centeredcell\" colspan=2>Checkout from<br><a href=\"mailto:".DBTestUtil::getTestEmail()."\">Test Mod</a></td>
			</tr>
		</table>";
	
		$this->assertPageEquals($expectedPage, $pageData);
	
	}
	
	public function testGetOurEquipForDisabledUser(){
	
		$this->setSessionUserDisabled();
		
		require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/ourequip.php';
	
		$expectedPage = "<center><h3>Our Equipment</h3></center>
		<center><b><a href=\"#Category 1\">Category 1</a> - <a href=\"#Category 2\">Category 2</a></b></center>
		<h3>Category 1</h3>
		<table class=\"ourequip\">
			<tr>
				<td width=\"40%\" class=\"header\" id=\"Category 1\">Equipment Name</th>
				<td width=\"15%\"  class=\"header\">--</th>
				<td width=\"25%\" class=\"header\">Status</th>
				<td width=\"20%\" class=\"header\">--</th>
			</tr>
		</table>
		
		<h3>Category 2</h3>
		<table class=\"ourequip\">
			<tr>
				<td width=\"40%\" class=\"header\" id=\"Category 2\">Equipment Name</th>
				<td width=\"15%\"  class=\"header\">--</th>
				<td width=\"25%\" class=\"header\">Status</th>
				<td width=\"20%\" class=\"header\">--</th>
			</tr>
		</table>";
	
		$this->assertPageEquals($expectedPage, $pageData);
	
	}

}

?>