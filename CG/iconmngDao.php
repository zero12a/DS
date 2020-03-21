<?php
//DAO
 
class iconmngDao
{
	function __construct(){
		global $log;
		$log->info("IconmngDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("IconmngDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("IconmngDao-__toString");
	}
	//insF    
	public function insF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "insF";
		$RtnVal["SQLTXT"] = "insert into CG_ICONMNG (
	IMGNM ,IMGSVRNM ,IMGSIZE , IMGHASH, IMGTYPE, ADDDT
)values (
	#{G3-ICONFILE_NM}, #{G3-ICONFILE_SVRNM}, #{G3-ICONFILE_SIZE}, #{G3-ICONFILE_HASH}, #{G3-ICONFILE_IMGTYPE}
	, date_format(sysdate(),'%Y%m%d%H%i%s')
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssss";
		return $RtnVal;
    }  
	//selG    
	public function selG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "selG";
		$RtnVal["SQLTXT"] = "select ICONSEQ ,IMGNM ,IMGSVRNM ,IMGSIZE , ifnull(IMGHASH,'') as IMGHASH, ifnull(IMGTYPE,'') as IMGTYPE
, 'pppppp' as CODEMIRROR
, ADDDT
from CG_ICONMNG";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>