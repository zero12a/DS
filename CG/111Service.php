<?php
//SVC
 
//include_once('111Interface.php');
include_once('111Dao.php');
//class 111Service implements 111Interface
class 111Service 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("111Service-__construct");

		$this->DAO = new 111Dao();
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("111Service-__destruct");

		unset($this->DAO);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("111Service-__toString");
	}
}
                                                             
?>
