<?php

/*

Student Media Reservation System
Author: Andrew Melton

Filename: functions.php

Purpose: 
	This file contains all general purpose functions and links to other
		required functions in the lib folder.
	
Known Bugs/Fixes:

	None
	
*/

require_once 'config.php';
require_once './lib/constants.php';
require_once './lib/db_functions.php';
require_once './lib/email_functions.php';



/*

	This returns the variable set in the config file.

*/

function getConfigVar($v_name){

	global $config;
	
	return $config[$v_name];
	
}


/*

	New Encryption Scheme, BLOWFISH

	Known "Bug": This will throw a warning, saying that it isn't the most secure way of encrypting.
	Fix: Turn off error reporting to call.

*/

function encrypt($v_text){

	error_reporting(0);
	return mcrypt_encrypt(MCRYPT_BLOWFISH,getConfigVar('BLOWFISH_key'),$v_text,MCRYPT_MODE_CFB);
	error_reporting(E_ALL);
	
}

/*
	
	New Encryption Scheme, BLOWFISH

	Known "Bug": This will throw a warning, saying that it isn't the most secure way of encrypting.
	Fix: Turn off error reporting to call.

*/

function decrypt($v_text){

	error_reporting(0);
	return mcrypt_decrypt(MCRYPT_BLOWFISH,getConfigVar('BLOWFISH_key'),$v_text,MCRYPT_MODE_CFB);
	error_reporting(E_ALL);
	
}

/*
	
	This is the old Encrypt method, it's left in for the convert script.
	The reason for the change is that DES only encrypts the first 8
	Characters of a text, the rest is truncated. The new scheme, BLOWFISH
	is a much better algorithm.

	Known "Bug": This will throw a warning, saying that it isn't the most secure way of encrypting.

*/

function oldEncrypt($v_text){
 
	return mcrypt_encrypt(MCRYPT_DES,getConfigVar('DES_key'),$v_text,MCRYPT_MODE_CFB);
	
}

/*

	Known "Bug": This will throw a warning, saying that it isn't the most secure way of encrypting.

*/

function oldDecrypt($v_text){
	
	return mcrypt_decrypt(MCRYPT_DES,getConfigVar('DES_key'),$v_text,MCRYPT_MODE_CFB);
	
}


function handleFileError($error){

	$errorMessage = "";
	
	if($error = UPLOAD_ERR_INI_SIZE){
	
		$errorMessage = "File Size Limit Exceeded [PHP INI]";
	
	}
	else if($error = UPLOAD_ERR_FORM_SIZE){
	
		$errorMessage = "File Size Limit Exceeded [FORM]";
	
	}
	else if($error = UPLOAD_ERR_PARTIAL){
	
		$errorMessage = "Error during transfer [Partial Upload]";
	
	}
	else if($error = UPLOAD_NO_FILE){
	
		$errorMessage = "No file was uploaded";
	
	}
	else if($error = UPLOAD_ERR_EXTENSION){
	
		$errorMessage = "Error during transfer [Extension]";
	
	}
	
	return $errorMessage;

}

function getClientIP(){

	return $_SERVER['REMOTE_ADDR'];


}

function getClientHostnameFromIP(){

	return gethostbyaddr(getClientIP());

}

function getClientHostname(){

	if(isset($_SEVER['REMOTE_HOST']))
		return $_SERVER['REMOTE_HOST'];
	else
		return getClientHostnameFromIP();
		
}

/*

	This will generate a random password....

*/

function generatePassword($length=9, $strength=0) {
	$vowels = 'aeiouy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEIOUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}

?>