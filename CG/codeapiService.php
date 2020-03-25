<?php
//SVC
 
//include_once('CodeapiInterface.php');
include_once('codeapiDao.php');
//class CodeapiService implements CodeapiInterface
class codeapiService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("CodeapiService-__construct");

		$this->DAO = new codeapiDao();
		$this->DB["CGCORE"] = getDbConn($CFG["CFG_DB"]["CGCORE"]);
		$this->DB["CGPJT1"] = getDbConn($CFG["CFG_DB"]["CGPJT1"]);
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("CodeapiService-__destruct");

		unset($this->DAO);
		if($this->DB["CGCORE"])closeDb($this->DB["CGCORE"]);
		if($this->DB["CGPJT1"])closeDb($this->DB["CGPJT1"]);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("CodeapiService-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("CODEAPIService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("CODEAPIService-goG1Searchall________________________end");
	}
	//조회결과, 조회
	public function goG2Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("CODEAPIService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, CD

		//조회
		//V_GRPNM : 조회결과
		array_push($GRID["SQL"], $this->DAO->sCodeD($REQ)); //SEARCH, 조회,sCodeD
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
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("CODEAPIService-goG2Search________________________end");
	}
}
                                                             
?>
