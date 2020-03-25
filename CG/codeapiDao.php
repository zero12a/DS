<?php
//DAO
 
class codeapiDao
{
	function __construct(){
		global $log;
		$log->info("CodeapiDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("CodeapiDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("CodeapiDao-__toString");
	}
	//CDDETAIL    
	public function CDD($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "CDD";
		$RtnVal["SQLTXT"] = "select * 
from CG_CODED 
where  PCD = #{PCD} and CD = #{CD} and DELYN = 'N' and USEYN='Y' 
ORDER BY   ORD ASC ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//GETSVCSQLLIST    
	public function GETSVCSQLLIST($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "GETSVCSQLLIST";
		$RtnVal["SQLTXT"] = "select SQLSEQ as CD,SQLID as NM 
from CG_PGMSQL 
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and (PSQLSEQ is null or PSQLSEQ = 0) 
ORDER BY SQLORD ASC
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//PGMSEQ_POPUP    
	public function PGMSEQ_POPUP($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "PGMSEQ_POPUP";
		$RtnVal["SQLTXT"] = "select PGMID as CD, concat(PGMNM,'(',PGMID,')') as NM 
from CG_PGMINFO 
where PGMTYPE='POPUP' 
order by PGMNM desc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//PSQLSEQ    
	public function PSQLSEQ($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "PSQLSEQ";
		$RtnVal["SQLTXT"] = "select SQLSEQ as CD, SQLID as NM 
from CG_PGMSQL 
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} 
order by SQLORD asc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//SVCGRP    
	public function SVCGRP($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "SVCGRP";
		$RtnVal["SQLTXT"] = "select GRPID as CD,GRPID as NM 
from CG_PGMGRP 
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ}  
ORDER BY GRPORD ASC
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//SVRSEQ    
	public function SVRSEQ($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "SVRSEQ";
		$RtnVal["SQLTXT"] = "select SVRSEQ as CD, SVRNM as NM 
from CG_SVR 
where USERSEQ = #{USER.SEQ} order by SVRSEQ asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//VALIDSEQ    
	public function VALIDSEQ($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "VALIDSEQ";
		$RtnVal["SQLTXT"] = "select VALIDSEQ as CD, concat(SUBSTRING(DATATYPE,1,1),' ', VALIDNM) as NM 
from CG_VALID 
where PJTSEQ = #{PJTSEQ} 
order by DATATYPE, VALIDORD asc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//sCodeD    
	public function sCodeD($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "sCodeD";
		$RtnVal["SQLTXT"] = "select CD,NM 
from CG_CODED 
where  PCD = #{G1-PCD} and DELYN = 'N' and USEYN='Y' 
order by   ORD asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
}
                                                             
?>