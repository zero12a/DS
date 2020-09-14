<?php
//DAO
 
class pgmmngDao
{
	function __construct(){
		global $log;
		$log->info("PgmmngDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PgmmngDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PgmmngDao-__toString");
	}
	//PJT    
	public function sql1($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "sql1";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL
	,SVRLANG,DEPLOYKEY,PKGROOT,STARTDT,ENDDT
	,DELYN,ADDDT,MODDT 
from
 CG_PJTINFO	
where DELYN = 'N'
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//DD    
	public function sql10($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sql10";
		$RtnVal["SQLTXT"] = "select 
 a.PJTSEQ, a.DDSEQ, a.COLID, a.COLNM, a.COLSNM
 ,a.DATATYPE, a.DATASIZE, a.OBJTYPE, b.OBJTYPE as OBJTYPE_FORMVIEW, c.OBJTYPE as OBJTYPE_GRID
 ,a.LBLWIDTH, a.LBLHEIGHT, a.LBLALIGN, a.OBJWIDTH, a.OBJHEIGHT, a.OBJALIGN
 ,a.CRYPTCD, a.VALIDSEQ, a.PIYN
 ,a.ADDDT, a.MODDT
from CG_DD a
	left outer join CG_DDOBJ b on a.DDSEQ = b.DDSEQ and b.GRPTYPE = 'FORMVIEW'
	left outer join CG_DDOBJ c on a.DDSEQ = c.DDSEQ and c.GRPTYPE = 'GRID'
where PJTSEQ = #{G3-PJTSEQ} 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//DD    
	public function sql11($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sql11";
		$RtnVal["SQLTXT"] = "insert into CG_DD (
	PJTSEQ, COLID, COLNM, COLSNM, DATATYPE
	, DATASIZE, OBJTYPE, LBLWIDTH, LBLHEIGHT, LBLALIGN
	, OBJWIDTH, OBJHEIGHT, OBJALIGN, CRYPTCD, VALIDSEQ
	, PIYN
	, ADDDT, ADDID
) values (
	#{PJTSEQ}, #{COLID}, #{COLNM}, #{COLSNM}, #{DATATYPE}
	, #{DATASIZE}, #{OBJTYPE}, #{LBLWIDTH}, #{LBLHEIGHT}, #{LBLALIGN}
	, #{OBJWIDTH}, #{OBJHEIGHT}, #{OBJALIGN}, #{CRYPTCD}, #{VALIDSEQ}, if(#{PIYN}='','N',#{PIYN})
	,date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
) 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "issssissssssssissi";
		return $RtnVal;
    }  
	//DD    
	public function sql12($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sql12";
		$RtnVal["SQLTXT"] = "update CG_DD
set
	COLID = #{COLID}, COLNM = #{COLNM}, COLSNM = #{COLSNM}, DATATYPE = #{DATATYPE}, DATASIZE = #{DATASIZE}
	, OBJTYPE = #{OBJTYPE}, LBLWIDTH = #{LBLWIDTH}, LBLHEIGHT = #{LBLHEIGHT}, LBLALIGN = #{LBLALIGN}
	, OBJWIDTH = #{OBJWIDTH}, OBJHEIGHT = #{OBJHEIGHT}, OBJALIGN = #{OBJALIGN}, CRYPTCD = #{CRYPTCD}, VALIDSEQ = #{VALIDSEQ}
	, PIYN = #{PIYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
where PJTSEQ = #{PJTSEQ} and DDSEQ = #{DDSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssissssssssisiii";
		return $RtnVal;
    }  
	//DD    
	public function sql13($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sql13";
		$RtnVal["SQLTXT"] = "delete from CG_DD 
where PJTSEQ = #{PJTSEQ} and DDSEQ = #{DDSEQ} 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//PJT    
	public function sql2($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "sql2";
		$RtnVal["SQLTXT"] = "update CG_PJTINFO set DELYN = 'Y' where PJTSEQ = #{PJTSEQ} 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("PJTSEQ"	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//PJT    
	public function sql3($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "sql3";
		$RtnVal["SQLTXT"] = "update CG_PJTINFO set 
PJTID = #{PJTID}, PJTNM = #{PJTNM},FILECHARSET = #{FILECHARSET}, UITOOL = #{UITOOL}
, SVRLANG = #{SVRLANG}, STARTDT = #{STARTDT}, ENDDT = #{ENDDT}
, DEPLOYKEY = #{DEPLOYKEY}, PKGROOT = #{PKGROOT}
, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
where PJTSEQ = #{PJTSEQ} 

";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssssssssii";
		return $RtnVal;
    }  
	//PJT    
	public function sql4($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "sql4";
		$RtnVal["SQLTXT"] = "insert into CG_PJTINFO (
	PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG
	,DEPLOYKEY,PKGROOT,STARTDT,ENDDT
	,ADDDT,ADDID
) values (
	#{PJTID},#{PJTNM},#{FILECHARSET},#{UITOOL},#{SVRLANG}
	, #{DEPLOYKEY},#{PKGROOT},#{STARTDT},#{ENDDT}
	,date_format(sysdate(),'%Y%m%d%H%i%s'),#{USER.SEQ}
	)
	";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssssssssi";
		return $RtnVal;
    }  
	//PGM    
	public function sql6($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sql6";
		$RtnVal["SQLTXT"] = "select 
	PJTSEQ, PGMSEQ, PGMID, PGMNM, VIEWURL
	, PGMTYPE, POPWIDTH, POPHEIGHT, SECTYPE, PKGGRP
	, LOGINYN, DFTCTLGRPID, DFTCTLFNCID
	, ADDDT, MODDT 
from
 CG_PGMINFO	
where PJTSEQ = #{G3-PJTSEQ} 
 ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//PGM    
	public function sql7($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sql7";
		$RtnVal["SQLTXT"] = "insert into CG_PGMINFO(
	 PJTSEQ, PGMID, PGMNM, PKGGRP, PGMTYPE
	, POPWIDTH, POPHEIGHT, SECTYPE, LOGINYN, DFTCTLGRPID
	, DFTCTLFNCID
	, ADDDT, ADDID
) values (
	 #{PJTSEQ},#{PGMID},#{PGMNM}, #{PKGGRP}, #{PGMTYPE}
	, #{POPWIDTH}, #{POPHEIGHT}, #{SECTYPE}, #{LOGINYN}, #{DFTCTLGRPID}
	, #{DFTCTLFNCID}
	 ,date_format(sysdate(),'%Y%m%d%H%i%s'),#{USER.SEQ}
) 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "issssssssssi";
		return $RtnVal;
    }  
	//PGM    
	public function sql8($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sql8";
		$RtnVal["SQLTXT"] = "update
 CG_PGMINFO
set 
 PGMNM = #{PGMNM}, PGMID = #{PGMID}, PKGGRP = #{PKGGRP}, PGMTYPE = #{PGMTYPE}
 , POPWIDTH = #{POPWIDTH}, POPHEIGHT = #{POPHEIGHT}, SECTYPE = #{SECTYPE}, LOGINYN = #{LOGINYN}, DFTCTLGRPID = #{DFTCTLGRPID}
 , DFTCTLFNCID = #{DFTCTLFNCID}
 , MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssssssssiii";
		return $RtnVal;
    }  
	//PGM    
	public function sql9($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sql9";
		$RtnVal["SQLTXT"] = "delete from CG_PGMINFO
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
}
                                                             
?>