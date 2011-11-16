<?php
	
class DBTestUtil{
	
	private static $testEmail = "apmelton@radford.edu";
	private static $initDate;
	private static $initDateTime;

	public static function getTestInitDate(){

		return DBTestUtil::$initDate;

	}

	public static function getTestInitDateTime(){

		return DBTestUtil::$initDateTime;

	}
	
	public static function getTestEmail(){
	
		return DBTestUtil::$testEmail;
	
	}

	public static function incrementDateBy($date, $numDays){

		$start_Date = new DateTime(''.$date.' 00:00:00');
		$interval = new DateInterval("P".$numDays."D");
		$start_Date->add($interval);
		$enddate = $start_Date->format("Y-m-d");
		return $enddate;
	}

	public static function decrementDateBy($date, $numDays){

		$start_Date = new DateTime(''.$date.' 00:00:00');
		$interval = new DateInterval("P".$numDays."D");
		$start_Date->sub($interval);
		$enddate = $start_Date->format("Y-m-d");
		return $enddate;
	}

	public static function incrementDateTimeByDays($date, $numDays){

		$start_Date = new DateTime($date);
		$interval = new DateInterval("P".$numDays."D");
		$start_Date->add($interval);
		$enddate = $start_Date->format("Y-m-d");
		return $enddate;
	}

	public static function decrementDateTimeByDays($date, $numDays){

		$start_Date = new DateTime($date);
		$interval = new DateInterval("P".$numDays."D");
		$start_Date->sub($interval);
		$enddate = $start_Date->format("Y-m-d H:i:s");
		return $enddate;
	}
	
	private static function addUsers(){
		// Admin
		// user_id = 1
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_users SET
			username = 'Admin', name = 'Test Admin',
			password = '".encrypt('TestPass1')."', email = '".DBTestUtil::getTestEmail()."',
			user_level = '".getConfigVar('admin_rank')."'");
		
		// Moderator
		// user_id = 2
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_users SET
			username = 'Mod', name = 'Test Mod',
			password = '".encrypt('TestPass1')."', email = '".DBTestUtil::getTestEmail()."',
			user_level = '".getConfigVar('moderator_rank')."'");
	
		// Normal User
		// user_id = 3
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_users SET
			username = 'User', name = 'Test User',
			password = '".encrypt('TestPass1')."', email = '".DBTestUtil::getTestEmail()."',
			user_level = '1'");
		
		// Disabled
		// user_id = 4
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_users SET
			username = 'Diabled', name = 'Disabled User',
			password = '".encrypt('TestPass1')."', email = '".DBTestUtil::getTestEmail()."',
			user_level = '0'");
		
		// Too Many Active Warnings
		// user_id = 5
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_users SET
			username = 'warned', name = 'Bad User',
			password = '".encrypt('TestPass1')."', email = '".DBTestUtil::getTestEmail()."',
			user_level = '1'");
	}
	
	private static function addEquipment(){
	
		// Any user - First Category
		// equip_id = 1
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_equipment SET
			name = 'All Users1', type = 'Category 1',
			serial = '1234567', description = 'TestDescription',
			max_length = '5', min_user_level = '1', checkoutfrom = '-1'");

		// Any user - Second Category
		// equip_id = 2
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_equipment SET
			name = 'All Users2', type = 'Category 2',
			serial = '1234567', description = 'TestDescription',
			max_length = '5', min_user_level = '1', checkoutfrom = '-1'");

		// Only Moderators
		// equip_id = 3
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_equipment SET
			name = 'Only Mods', type = 'Category 1',
			serial = '1234567', description = 'TestDescription',
			max_length = '5', min_user_level = '".getConfigVar('moderator_rank')."',
			checkoutfrom = '-1'");

		// Any User - Check out from mod
		// equip_id = 4
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_equipment SET
			name = 'Check Out From', type = 'Category 2',
			serial = '1234567', description = 'TestDescription',
			max_length = '5', min_user_level = '1',
			checkoutfrom = '2'");
	}

	private static function addReservations(){
	
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_reservations SET
			equip_id = '1', user_id = '1',
			start_date = '".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(), 10)."', end_date = '".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(),5)."',
			length = '5', mod_status = '".RES_STATUS_CONFIRMED."'");
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_reservations SET
			equip_id = '2', user_id = '1',
			start_date = '".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(), 12)."', end_date = '".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(),11)."',
			length = '1', mod_status = '".RES_STATUS_DENIED."'");
	
	}

	private static function addMessages(){
	
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_messages SET
			user_id = '1', body = 'This is a very old message.',
			start_date = '".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(), 20)."', end_date = '".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(),15)."',
			priority = '1'");
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_messages SET
			user_id = '1', body = 'This is a low priority message.',
			start_date = '".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(), 5)."', end_date = '".DBTestUtil::incrementDateBy(DBTestUtil::getTestInitDate(),5)."',
			priority = '1'");
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_messages SET
			user_id = '1', body = 'This is a high priority message.',
			start_date = '".DBTestUtil::decrementDateBy(DBTestUtil::getTestInitDate(), 4)."', end_date = '".DBTestUtil::incrementDateBy(DBTestUtil::getTestInitDate(),6)."',
			priority = '2'");
	
	}

	private static function addWarnings(){
	
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_warnings SET
			user_id = '3', reason = 'This is an active warning.',
			time = '".DBTestUtil::decrementDateTimeByDays(DBTestUtil::getTestInitDateTime(), 20)."',
			type = '".RES_WARNING_ACTIVE."'");
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_warnings SET
			user_id = '3', reason = 'This is an inactive warning.',
			time = '".DBTestUtil::decrementDateTimeByDays(DBTestUtil::getTestInitDateTime(), 20)."',
			type = '".RES_WARNING_INACTIVE."'");
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_warnings SET
			user_id = '3', reason = 'This is a note.',
			time = '".DBTestUtil::decrementDateTimeByDays(DBTestUtil::getTestInitDateTime(), 20)."',
			type = '".RES_WARNING_NOTE."'");
			
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_warnings SET
			user_id = '5', reason = 'This is an active warning.',
			time = '".DBTestUtil::decrementDateTimeByDays(DBTestUtil::getTestInitDateTime(), 20)."',
			type = '".RES_WARNING_ACTIVE."'");
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_warnings SET
			user_id = '5', reason = 'This is an active warning.',
			time = '".DBTestUtil::decrementDateTimeByDays(DBTestUtil::getTestInitDateTime(), 20)."',
			type = '".RES_WARNING_ACTIVE."'");
		doQuery("INSERT INTO ".getConfigVar('db_prefix')."_warnings SET
			user_id = '5', reason = 'This is an active warning.',
			time = '".DBTestUtil::decrementDateTimeByDays(DBTestUtil::getTestInitDateTime(), 20)."',
			type = '".RES_WARNING_ACTIVE."'");
	
	}
	
	public static function init($date, $dateTime){
	
		DBTestUtil::$initDate = $date;
		DBTestUtil::$initDateTime = $dateTime;
	
	}
	
	public static function setup(){
	
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_users");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_equipment");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_reservations");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_messages");

		DBTestUtil::addUsers();
		DBTestUtil::addEquipment();
		DBTestUtil::addReservations();
		DBTestUtil::addMessages();
		DBTestUtil::addWarnings();
	
	}
	
	public static function teardown(){

		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_users");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_equipment");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_blackouts");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_error_log");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_log");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_messages");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_reservations");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_users");
		doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_warnings");
	
	}
	
}
	
?>
