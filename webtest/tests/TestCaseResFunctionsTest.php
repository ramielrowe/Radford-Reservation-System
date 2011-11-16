<?php

require_once 'ResSysDBTest.php';

class TestCaseResFunctionsTest extends ResSysDBTest{

	public function testCreateReservationFromWeekdaytoWeekday(){
	
		$this->setSessionUserAdmin();
		$startDate = '2011-11-14'; # A Monday
		$length = 1;
		$endDate = DBTestUtil::incrementDateBy($startDate, $length);
		$equipId = 1;
		$userComment = "test user comment";
		$adminComment = "test admin comment";
		$modStatus = RES_STATUS_PENDING;
		
		createReservation(getSessionVariable('user_id'), $equipId, $startDate, $length, $userComment, $adminComment, $modStatus);
		
		$actualReservation = mysql_fetch_assoc(doQuery("select * from ".getConfigVar('db_prefix')."_reservations ORDER BY res_id DESC LIMIT 1"));
		
		$this->assertEquals(getSessionVariable('user_id'), $actualReservation['user_id'], "User IDs not equal");
		$this->assertEquals($equipId, $actualReservation['equip_id'], "Equip IDs not equal");
		$this->assertEquals($startDate, $actualReservation['start_date'], "Start dates not equal");
		$this->assertEquals($length, $actualReservation['length'], "Lengths not equal");
		$this->assertEquals($endDate, $actualReservation['end_date'], "End dates not equal");
		$this->assertEquals($userComment, $actualReservation['user_comment'], "User comments not equal");
		$this->assertEquals($adminComment, $actualReservation['admin_comment'], "Admin comments not equal");
		$this->assertEquals($modStatus, $actualReservation['mod_status'], "Statuses not equal");
	
	}
	public function testCreateReservationFromWeekdaytoWeekend(){
	
		$this->setSessionUserAdmin();
		$startDate = '2011-11-18'; # A Friday
		$length = 1;
		$endDate = '2011-11-21'; # The Next Monday
		$actualLength = 3;
		$equipId = 1;
		$userComment = "test user comment";
		$adminComment = "test admin comment";
		$modStatus = RES_STATUS_PENDING;
		
		createReservation(getSessionVariable('user_id'), $equipId, $startDate, $length, $userComment, $adminComment, $modStatus);
		
		$actualReservation = mysql_fetch_assoc(doQuery("select * from ".getConfigVar('db_prefix')."_reservations ORDER BY res_id DESC LIMIT 1"));
		
		$this->assertEquals(getSessionVariable('user_id'), $actualReservation['user_id'], "User IDs not equal");
		$this->assertEquals($equipId, $actualReservation['equip_id'], "Equip IDs not equal");
		$this->assertEquals($startDate, $actualReservation['start_date'], "Start dates not equal");
		$this->assertEquals($actualLength, $actualReservation['length'], "Lengths not equal");
		$this->assertEquals($endDate, $actualReservation['end_date'], "End dates not equal");
		$this->assertEquals($userComment, $actualReservation['user_comment'], "User comments not equal");
		$this->assertEquals($adminComment, $actualReservation['admin_comment'], "Admin comments not equal");
		$this->assertEquals($modStatus, $actualReservation['mod_status'], "Statuses not equal");
	
	}
	
}

?>