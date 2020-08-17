<?php
//SVC
 
//include_once('33Interface.php');
include_once('33Dao.php');
//class 33Service implements 33Interface
class 33Service 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("33Service-__construct");

		$this->DAO = new 33Dao();
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("33Service-__destruct");

		unset($this->DAO);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("33Service-__toString");
	}
}
                                                             
?>
