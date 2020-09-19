<?php
//SVC
 
//include_once('UsermngwixInterface.php');
include_once('usermngwixDao.php');
//class UsermngwixService implements UsermngwixInterface
class usermngwixService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("UsermngwixService-__construct");

		$this->DAO = new usermngwixDao();
		$this->DB["CGCORE"] = getDbConn($CFG["CFG_DB"]["CGCORE"]);
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("UsermngwixService-__destruct");

		unset($this->DAO);
		if($this->DB["CGCORE"])closeDb($this->DB["CGCORE"]);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("UsermngwixService-__toString");
	}
	//사용자1, 비번변경
	public function goG2Userdef(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG2Userdef________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G2";
		$GRID["JSON"]=$REQ[$grpId."-JSON"];
		$GRID["COLORD"] = "USERSEQ,EMAIL,PASSWD,EMAILVALIDYN,LASTPWCHGDT,PWFAILCNT,LOCKYN,FREEZEDT,LOCKDT,SERVERSEQ,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["COLCRYPT"] = array("PASSWD"=>"HASH");	
		$GRID["KEYCOLID"] = "";  //KEY컬럼
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//V_GRPNM : 사용자1
		array_push($GRID["SQL"]["U"], $this->DAO->chgUserPwG($REQ)); //USERDEF, 비번변경,USR
		$tmpVal = requireGridwixSaveArray($GRID["COLORD"],$GRID["JSON"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridwixSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG2Userdef________________________end");
	}
	//사용자1, 조회
	public function goG2Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG2Search________________________start");
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_WEBIX";
		$GRID["KEYCOLIDX"] = ""; // KEY 컬럼
		//조회
		//V_GRPNM : 사용자1
		array_push($GRID["SQL"], $this->DAO->selUserG($REQ)); //SEARCH, 조회,USR
		//암호화컬럼
		$GRID["COLCRYPT"] = array("PASSWD"=>"HASH");
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG2Search________________________end");
	}
	//사용자1, S
	public function goG2Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG2Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G2";
		$GRID["JSON"]=$REQ[$grpId."-JSON"];
		$GRID["COLORD"] = "USERSEQ,EMAIL,PASSWD,EMAILVALIDYN,LASTPWCHGDT,PWFAILCNT,LOCKYN,FREEZEDT,LOCKDT,SERVERSEQ,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["COLCRYPT"] = array("PASSWD"=>"HASH");	
		$GRID["KEYCOLID"] = "";  //KEY컬럼
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//V_GRPNM : 사용자1
		array_push($GRID["SQL"]["C"], $this->DAO->insUserG($REQ)); //SAVE, S,USR
		//V_GRPNM : 사용자1
		array_push($GRID["SQL"]["U"], $this->DAO->updUserG($REQ)); //SAVE, S,USR
		$tmpVal = requireGridwixSaveArray($GRID["COLORD"],$GRID["JSON"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridwixSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG2Save________________________end");
	}
	//사용자1, E
	public function goG2Excel(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG2Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG2Excel________________________end");
	}
	//사용자1, 선택저장
	public function goG2Chksave(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG2Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG2Chksave________________________end");
	}
	//FILE저장소, 사용자정의
	public function goG3Userdef(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG3Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG3Userdef________________________end");
	}
	//FILE저장소, 조회
	public function goG3Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG3Search________________________start");
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_WEBIX";
		$GRID["KEYCOLIDX"] = ""; // KEY 컬럼
		//조회
		//V_GRPNM : FILE저장소
		array_push($GRID["SQL"], $this->DAO->selFileG($REQ)); //SEARCH, 조회,FILE
		//암호화컬럼
		$GRID["COLCRYPT"] = array("CREKEY"=>"CRYPT","CRESECRET"=>"CRYPT");
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG3Search________________________end");
	}
	//FILE저장소, S
	public function goG3Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG3Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G3";
		$GRID["JSON"]=$REQ[$grpId."-JSON"];
		$GRID["COLORD"] = "FILESTORESEQ,USERSEQ,STORETYPE,STOREID,STORENM,CREKEY,CRESECRET,REGION,BUCKET,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["COLCRYPT"] = array("CREKEY"=>"CRYPT","CRESECRET"=>"CRYPT");	
		$GRID["KEYCOLID"] = "";  //KEY컬럼
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//V_GRPNM : FILE저장소
		array_push($GRID["SQL"]["C"], $this->DAO->insFileG($REQ)); //SAVE, S,FILE
		//V_GRPNM : FILE저장소
		array_push($GRID["SQL"]["D"], $this->DAO->delFileG($REQ)); //SAVE, S,FILE
		//V_GRPNM : FILE저장소
		array_push($GRID["SQL"]["U"], $this->DAO->updFileG($REQ)); //SAVE, S,FILE
		$tmpVal = requireGridwixSaveArray($GRID["COLORD"],$GRID["JSON"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridwixSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG3Save________________________end");
	}
	//FILE저장소, E
	public function goG3Excel(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG3Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG3Excel________________________end");
	}
	//FILE저장소, 선택저장
	public function goG3Chksave(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG3Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG3Chksave________________________end");
	}
	//DB저장소, 사용자정의
	public function goG4Userdef(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG4Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG4Userdef________________________end");
	}
	//DB저장소, 조회
	public function goG4Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG4Search________________________start");
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_WEBIX";
		$GRID["KEYCOLIDX"] = ""; // KEY 컬럼
		//조회
		//V_GRPNM : DB저장소
		array_push($GRID["SQL"], $this->DAO->selSvrG($REQ)); //SEARCH, 조회,SVR
		//암호화컬럼
		$GRID["COLCRYPT"] = array("DBUSRPW"=>"CRYPT");
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG4Search________________________end");
	}
	//DB저장소, S
	public function goG4Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG4Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G4";
		$GRID["JSON"]=$REQ[$grpId."-JSON"];
		$GRID["COLORD"] = "SVRSEQ,SVRID,SVRNM,PJTSEQ,USERSEQ,DBDRIVER,DBHOST,DBPORT,DBNAME,DBUSRID,DBUSRPW,USEYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["COLCRYPT"] = array("DBUSRPW"=>"CRYPT");	
		$GRID["KEYCOLID"] = "";  //KEY컬럼
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//V_GRPNM : DB저장소
		array_push($GRID["SQL"]["C"], $this->DAO->insSvrG($REQ)); //SAVE, S,SvR
		//V_GRPNM : DB저장소
		array_push($GRID["SQL"]["U"], $this->DAO->updSvrG($REQ)); //SAVE, S,SVR
		$tmpVal = requireGridwixSaveArray($GRID["COLORD"],$GRID["JSON"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridwixSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG4Save________________________end");
	}
	//DB저장소, E
	public function goG4Excel(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG4Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG4Excel________________________end");
	}
	//DB저장소, 선택저장
	public function goG4Chksave(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("USERMNGWIXService-goG4Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("USERMNGWIXService-goG4Chksave________________________end");
	}
}
                                                             
?>
