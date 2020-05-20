<?php
//DAO
 
class jqxgridDao
{
	function __construct(){
		global $log;
		$log->info("JqxgridDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("JqxgridDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("JqxgridDao-__toString");
	}
	//selG    
	public function selG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "selG";
		$RtnVal["SQLTXT"] = "select PGMSEQ, PGMID, PGMNM from CG_PGMINFO";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>