<?php
//SVC
 
//include_once('PjtenvInterface.php');
include_once('pjtenvDao.php');
//class PjtenvService implements PjtenvInterface
class pjtenvService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("PjtenvService-__construct");

		$this->DAO = new pjtenvDao();
		$this->DB["CGCORE"] = getDbConn($CFG["CFG_DB"]["CGCORE"]);
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("PjtenvService-__destruct");

		unset($this->DAO);
		if($this->DB["CGCORE"])closeDb($this->DB["CGCORE"]);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("PjtenvService-__toString");
	}
	//CONFIG, 사용자정의
	public function goG6Userdef(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTENVService-goG6Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTENVService-goG6Userdef________________________end");
	}
	//CONFIG, 조회
	public function goG6Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTENVService-goG6Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, CFGSEQ

		//조회
		//V_GRPNM : CONFIG
		array_push($GRID["SQL"], $this->DAO->impR($REQ)); //SEARCH, 조회,CONFIG
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G6]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTENVService-goG6Search________________________end");
	}
	//CONFIG, 저장
	public function goG6Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTENVService-goG6Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G6";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "CFGSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : CONFIG
		array_push($GRID["SQL"]["C"], $this->DAO->impC($REQ)); //SAVE, 저장,CONFIG
		//V_GRPNM : CONFIG
		array_push($GRID["SQL"]["U"], $this->DAO->impU($REQ)); //SAVE, 저장,CONFIG
		//V_GRPNM : CONFIG
		array_push($GRID["SQL"]["D"], $this->DAO->impD($REQ)); //SAVE, 저장,CONFIG
		$tmpVal = requireGridSaveArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G6]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTENVService-goG6Save________________________end");
	}
	//CONFIG, 엑셀다운로드
	public function goG6Excel(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTENVService-goG6Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTENVService-goG6Excel________________________end");
	}
	//FILE, 사용자정의
	public function goG7Userdef(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTENVService-goG7Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTENVService-goG7Userdef________________________end");
	}
	//FILE, 조회
	public function goG7Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTENVService-goG7Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, FILESEQ

		//조회
		//V_GRPNM : FILE
		array_push($GRID["SQL"], $this->DAO->fileR($REQ)); //SEARCH, 조회,FILE
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G7]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTENVService-goG7Search________________________end");
	}
	//FILE, 저장
	public function goG7Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTENVService-goG7Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G7";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "FILESEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : FILE
		array_push($GRID["SQL"]["C"], $this->DAO->fileC($REQ)); //SAVE, 저장,FILE
		//V_GRPNM : FILE
		array_push($GRID["SQL"]["U"], $this->DAO->fileU($REQ)); //SAVE, 저장,FILE
		$tmpVal = requireGridSaveArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G7]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTENVService-goG7Save________________________end");
	}
	//FILE, 엑셀다운로드
	public function goG7Excel(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTENVService-goG7Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTENVService-goG7Excel________________________end");
	}
}
                                                             
?>
