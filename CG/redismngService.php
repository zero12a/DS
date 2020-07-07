<?php
//SVC
 
//include_once('RedismngInterface.php');
include_once('redismngDao.php');
//class RedismngService implements RedismngInterface
class redismngService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("RedismngService-__construct");

		$this->DAO = new redismngDao();
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("RedismngService-__destruct");

		unset($this->DAO);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("RedismngService-__toString");
	}
	//, 로그인
	public function goG1Searchall(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("REDISMNGService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("REDISMNGService-goG1Searchall________________________end");
	}
	//키상세, 조회
	public function goG3Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("REDISMNGService-goG3Search________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("REDISMNGService-goG3Search________________________end");
	}
	//키상세, 저장
	public function goG3Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("REDISMNGService-goG3Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("REDISMNGService-goG3Save________________________end");
	}
	//키상세, 삭제
	public function goG3Delete(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("REDISMNGService-goG3Delete________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("REDISMNGService-goG3Delete________________________end");
	}
}
                                                             
?>
