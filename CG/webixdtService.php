<?php
//SVC
 
//include_once('WebixdtInterface.php');
include_once('webixdtDao.php');
//class WebixdtService implements WebixdtInterface
class webixdtService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("WebixdtService-__construct");

		$this->DAO = new webixdtDao();
		$this->DB["CGPJT1"] = getDbConn($CFG["CFG_DB"]["CGPJT1"]);
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("WebixdtService-__destruct");

		unset($this->DAO);
		if($this->DB["CGPJT1"])closeDb($this->DB["CGPJT1"]);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("WebixdtService-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("WEBIXDTService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("WEBIXDTService-goG1Searchall________________________end");
	}
	//, 저장
	public function goG1Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("WEBIXDTService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("WEBIXDTService-goG1Save________________________end");
	}
	//11, 조회
	public function goG2Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("WEBIXDTService-goG2Search________________________start");
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_WEBIX";
		$GRID["KEYCOLIDX"] = "PGMSEQ"; // KEY 컬럼
		//조회
		//V_GRPNM : 11
		array_push($GRID["SQL"], $this->DAO->selG($REQ)); //SEARCH, 조회,selG
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
		$log->info("WEBIXDTService-goG2Search________________________end");
	}
	//11, 저장
	public function goG2Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("WEBIXDTService-goG2Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G2";
		$GRID["JSON"]=$REQ[$grpId."-JSON"];
		$GRID["COLORD"] = "PJTSEQ,PGMSEQ,PGMID,PGMNM"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "PGMSEQ";  //KEY컬럼
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//V_GRPNM : 11
		array_push($GRID["SQL"]["D"], $this->DAO->delG($REQ)); //SAVE, 저장,delG
		//V_GRPNM : 11
		array_push($GRID["SQL"]["C"], $this->DAO->insG($REQ)); //SAVE, 저장,insG
		//V_GRPNM : 11
		array_push($GRID["SQL"]["U"], $this->DAO->updG($REQ)); //SAVE, 저장,updG
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
		$log->info("WEBIXDTService-goG2Save________________________end");
	}
	//22, 조회
	public function goG3Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("WEBIXDTService-goG3Search________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("WEBIXDTService-goG3Search________________________end");
	}
	//22, 저장
	public function goG3Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("WEBIXDTService-goG3Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("WEBIXDTService-goG3Save________________________end");
	}
	//22, 삭제
	public function goG3Delete(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("WEBIXDTService-goG3Delete________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("WEBIXDTService-goG3Delete________________________end");
	}
}
                                                             
?>
