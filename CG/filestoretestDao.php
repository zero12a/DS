<?php
//DAO
 
class filestoretestDao
{
	function __construct(){
		global $log;
		$log->info("FilestoretestDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("FilestoretestDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("FilestoretestDao-__toString");
	}
	//insF    
	public function insF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "insF";
		$RtnVal["SQLTXT"] = "insert into APP_API ( MYFILE, MYFILESVRNM, ADD_DT )
values (
	#{G3-MYFILE1_NM}, #{G3-MYFILE1_SVRNM}, date_format(sysdate(),'%Y%m%d%H%i%s')
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//selF    
	public function selF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "selF";
		$RtnVal["SQLTXT"] = "SELECT API_SEQ, MYFILE, MYFILESVRNM, ADD_DT 
FROM APP_API
where API_SEQ = #{G2-API_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//selG    
	public function selG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "selG";
		$RtnVal["SQLTXT"] = "SELECT API_SEQ, MYFILE, MYFILESVRNM, ADD_DT FROM APP_API
order by api_seq desc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>