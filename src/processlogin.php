<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'functions.php';

/*

	Updates a user's password to the new Encrytipn Scheme

	See note "NewEncIf" below for the reasoning behind this.

*/

function updateUser($userid, $oldPass){

	$newpass = makeMySQLSafe(encrypt($oldPass));

	doQuery("UPDATE ".getDBPrefix()."_users SET password = '".$newpass."'  WHERE user_id = ".$userid."");

}

$id = $_POST['id'];
$password = $_POST['pass'];

$userq = processLogin($id);

$error = 0;

if(mysql_num_rows($userq)==0){

	$error = RES_ERROR_LOGIN_NO_USER;	

}else{

	$row = mysql_fetch_assoc($userq);

	if($row['password'] != encrypt($password)){

		$error = RES_ERROR_LOGIN_USER_PASS;

	}

}

$page = "";

if($error > 0){

	sleep(1);
	$page = "Location: ".getConfigVar("location")."index.php?pageid=login&loginoption=".$error;

}
else{
	
	$_SESSION['user_level'] = $row['user_level'];

	$_SESSION['user_id'] = $row['user_id'];

	sleep(1);

	$page = "Location: ".getConfigVar("location")."index.php?pageid=home&sesid=".session_id();

}

header($page);

?>