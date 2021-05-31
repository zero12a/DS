<?php
//DAO
 
class rdfluentdDao
{
	function __construct(){
		global $log;
		$log->info("RdfluentdDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("RdfluentdDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("RdfluentdDao-__toString");
	}
	//FLUENTD    
	public function selF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "RSYSLOG";
		$RtnVal["SQLID"] = "selF";
		$RtnVal["SQLTXT"] = "select 
	SEQ, SRC, CONTAINERNM, CONTAINERID, LOG
	, ADDDT
from
	FLUENTLOG
where
	SEQ = #{G2-SEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//FLUENTD    
	public function selG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "RSYSLOG";
		$RtnVal["SQLID"] = "selG";
		$RtnVal["SQLTXT"] = "select 
	SEQ, SRC, CONTAINERNM, CONTAINERID, LOG
	, ADDDT
from
	FLUENTLOG
where
	ADDDT >= date(#{G1-ADDDT})
	and ADDDT < DATE_ADD(date(#{G1-ADDDT}), INTERVAL 1 DAY)
	and case when length(#{G1-SRC}) > 0 then 
		SRC like concat('%',#{G1-SRC},'%')
		else 1 = 1 end
	and case when length(#{G1-CONTAINERNM}) > 0 then 
		SRC like concat('%',#{G1-CONTAINERNM},'%')
		else 1 = 1 end
	and case when length(#{G1-CONTAINERID}) > 0 then 
		SRC like concat('%',#{G1-CONTAINERID},'%')
		else 1 = 1 end
	and case when length(#{G1-LOG}) > 0 then 
		SRC like concat('%',#{G1-LOG},'%')
		else 1 = 1 end
order by SEQ desc
limit #{G1-ROWLIMIT}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssssssssi";
		return $RtnVal;
    }  
}
                                                             
?>