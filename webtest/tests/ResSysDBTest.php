<?php

require_once 'PHPUnit/Autoload.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '/DBTestUtil.php';

class ResSysDBTest extends PHPUnit_Framework_TestCase{

	public static function setUpBeforeClass(){
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '/config.php';
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../src/functions.php';
		
		DBTestUtil::init(getCurrentMySQLDate(), getCurrentMySQLDateTime());
		DBTestUtil::setup();
		
		session_start();
    }
	
	public static function tearDownAfterClass() {
		
		DBTestUtil::teardown();
		
		session_destroy();
    }
	
	public function setSessionUser($user_id, $user_level){

	setSessionVariable("user_id", $user_id);
	setSessionVariable("user_level", $user_level);

	}
	
	public function setSessionUserAdmin(){
	
		$this->setSessionUser(1, getConfigVar('admin_rank'));
	
	}
	public function setSessionUserMod(){
	
		$this->setSessionUser(2, getConfigVar('moderator_rank'));
	
	}
	public function setSessionUserNormal(){
	
		$this->setSessionUser(3, 1);
	
	}
	public function setSessionUserDisabled(){
	
		$this->setSessionUser(4, 0);
	
	}
	
	public function cleanHTML($html){
	
		$newHTML = preg_replace('/[\r\n]/', "", $html);
		$newHTML = preg_replace('/[\n]/', "", $newHTML);
	
		return preg_replace('/[\t]/', "", $newHTML);
	
	}

	public function assertPageEquals($expectedPage, $actualPage){
	
		$this->assertNotNull($actualPage);
		$this->assertEquals($this->cleanHTML($expectedPage), $this->cleanHTML($actualPage));
	
	}
	
}

?>