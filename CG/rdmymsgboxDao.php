<?php
//DAO
 
class rdmymsgboxDao
{
	function __construct(){
		global $log;
		$log->info("RdmymsgboxDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("RdmymsgboxDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("RdmymsgboxDao-__toString");
	}
	//BOX    
	public function selF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "RDCOMMON";
		$RtnVal["SQLID"] = "selF";
		$RtnVal["SQLTXT"] = "select
	MSG_BOX_SEQ, USR_SEQ, TITLE, BODY, SEND_DT, READ_DT, ADD_DT
from
	CMN_MSG_BOX
where MSG_BOX_SEQ = #{G2-MSG_BOX_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//BOX    
	public function selG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "RDCOMMON";
		$RtnVal["SQLID"] = "selG";
		$RtnVal["SQLTXT"] = "select
	MSG_BOX_SEQ, USR_SEQ, TITLE, BODY, SEND_DT, READ_DT, ADD_DT
from
	CMN_MSG_BOX
order by MSG_BOX_SEQ desc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>