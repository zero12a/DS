<?php
//DAO
 
class 33Dao
{
	function __construct(){
		global $log;
		$log->info("33Dao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("33Dao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("33Dao-__toString");
	}
}
                                                             
?>