<?php

	$testEmail = "apmelton@radford.edu";
	
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_users");
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_equipment");
	
	doQuery("INSERT INTO ".getConfigVar('db_prefix')."_users SET
		username = 'Admin', name = 'Test Admin',
		password = '".encrypt('TestPass1')."', email = '".$testEmail."',
		user_level = '".getConfigVar('admin_rank')."'");
		
	doQuery("INSERT INTO ".getConfigVar('db_prefix')."_users SET
		username = 'Mod', name = 'Test Mod',
		password = '".encrypt('TestPass1')."', email = '".$testEmail."',
		user_level = '".getConfigVar('moderator_rank')."'");
	
	doQuery("INSERT INTO ".getConfigVar('db_prefix')."_users SET
		username = 'User', name = 'Test User',
		password = '".encrypt('TestPass1')."', email = '".$testEmail."',
		user_level = '1'");
		
	doQuery("INSERT INTO ".getConfigVar('db_prefix')."_users SET
		username = 'Diabled', name = 'Disabled User',
		password = '".encrypt('TestPass1')."', email = '".$testEmail."',
		user_level = '0'");

	doQuery("INSERT INTO ".getConfigVar('db_prefix')."_equipment SET
		name = 'All Users1', type = 'Category 1',
		serial = '1234567', description = 'TestDescription',
		max_length = '5', min_user_level = '1', checkoutfrom = '-1'");

	doQuery("INSERT INTO ".getConfigVar('db_prefix')."_equipment SET
		name = 'All Users2', type = 'Category 2',
		serial = '1234567', description = 'TestDescription',
		max_length = '5', min_user_level = '1', checkoutfrom = '-1'");

	doQuery("INSERT INTO ".getConfigVar('db_prefix')."_equipment SET
		name = 'Only Mods', type = 'Category 1',
		serial = '1234567', description = 'TestDescription',
		max_length = '5', min_user_level = '".getConfigVar('moderator_rank')."',
		checkoutfrom = '-1'");

	doQuery("INSERT INTO ".getConfigVar('db_prefix')."_equipment SET
		name = 'Check Out From', type = 'Category 2',
		serial = '1234567', description = 'TestDescription',
		max_length = '5', min_user_level = '1',
		checkoutfrom = '2'");
?>
