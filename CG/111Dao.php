<?php
//DAO
 
class 111Dao
{
	function __construct(){
		global $log;
		$log->info("111Dao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("111Dao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("111Dao-__toString");
	}
}
                                                             
?>