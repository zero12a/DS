<?php
header("Content-Type: application/json; charset="); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = require_once('');//
require_once($CFG["CFG_LIBS_VENDOR"]);
require_once('Service.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
require_once('');//
require_once('');//
require_once('');//
require_once('');//
require_once('');//
require_once('');//
require_once('');//
//하위에서 LOADDING LIB 처리
array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$log = getLogger(
	array(
	"LIST_NM"=>"log_"
	, "PGM_ID"=>""
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("Control___________________________start");
$objAuth = new authObject();
//컨트롤 명령 받기
$ctl = "";
$ctl1 = reqGetString("CTLGRP",50);
$ctl2 = reqGetString("CTLFNC",50);
if($ctl1 == "" || $ctl2 == ""){
	JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
}else{
	$ctl = $ctl1 . "_" . $ctl2;
}//비로그인 : 권한정보 검사하기 (로그인검사, 권한검사 없이 패스)
$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"",$ctl,"Y");
	//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
//FILE먼저 : L1, 1
//FILE먼저 : C1, 조건1
//FILE먼저 : L2, 2
//FILE먼저 : G2, 사용자1
//FILE먼저 : G3, FILE저장소
//FILE먼저 : G4, DB저장소

//L1, 1 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )

//C1, 조건1 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )

//L2, 2 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )

//G2, 사용자1 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )

//G3, FILE저장소 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )

//G4, DB저장소 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
//,  입력값 필터 
$REQ["G2-JSON"] = json_decode($_POST["G2-JSON"],true);//사용자1	
$REQ["G3-JSON"] = json_decode($_POST["G3-JSON"],true);//FILE저장소	
$REQ["G4-JSON"] = json_decode($_POST["G4-JSON"],true);//DB저장소	
//,  입력값 필터 
$REQ["G2-JSON"] = filterGridJson(
	array(
		"JSON"=>$REQ["G2-JSON"]
		,"COLORD"=>",,,,,,,,,,,"
		,"VALID"=>
			array(
			""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			)
		,"FILTER"=>
			array(
			""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			)
	)
);
$REQ["G3-JSON"] = filterGridJson(
	array(
		"JSON"=>$REQ["G3-JSON"]
		,"COLORD"=>",,,,,,,,,,,,,,"
		,"VALID"=>
			array(
			""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			)
		,"FILTER"=>
			array(
			""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			)
	)
);
$REQ["G4-JSON"] = filterGridJson(
	array(
		"JSON"=>$REQ["G4-JSON"]
		,"COLORD"=>",,,,,,,,,,,,,,"
		,"VALID"=>
			array(
			""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			,""=>array("",)	
			)
		,"FILTER"=>
			array(
			""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			,""=>array("","//")
			)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new Service();
//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
switch ($ctl){
		case "G2_USERDEF" :
		echo $objService->goG2Userdef(); //사용자1, 비번변경
		break;
	case "G2_SEARCH" :
		echo $objService->goG2Search(); //사용자1, 조회
		break;
	case "G2_SAVE" :
		echo $objService->goG2Save(); //사용자1, S
		break;
	case "G2_EXCEL" :
		echo $objService->goG2Excel(); //사용자1, E
		break;
	case "G2_CHKSAVE" :
		echo $objService->goG2Chksave(); //사용자1, 선택저장
		break;
	case "G3_SEARCH" :
		echo $objService->goG3Search(); //FILE저장소, 조회
		break;
	case "G3_SAVE" :
		echo $objService->goG3Save(); //FILE저장소, S
		break;
	case "G3_EXCEL" :
		echo $objService->goG3Excel(); //FILE저장소, E
		break;
	case "G3_CHKSAVE" :
		echo $objService->goG3Chksave(); //FILE저장소, 선택저장
		break;
	case "G4_USERDEF" :
		echo $objService->goG4Userdef(); //DB저장소, 사용자정의
		break;
	case "G4_SEARCH" :
		echo $objService->goG4Search(); //DB저장소, 조회
		break;
	case "G4_SAVE" :
		echo $objService->goG4Save(); //DB저장소, S
		break;
	case "G4_EXCEL" :
		echo $objService->goG4Excel(); //DB저장소, E
		break;
	case "G4_CHKSAVE" :
		echo $objService->goG4Chksave(); //DB저장소, 선택저장
		break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}
array_push($_RTIME,array("[TIME 50.SVC]",microtime(true)));
if($PGM_CFG["SECTYPE"] == "POWER" || $PGM_CFG["SECTYPE"] == "PI") $objAuth->logUsrAuthD($reqToken,$resToken);;	//권한변경 로그 저장
	array_push($_RTIME,array("[TIME 60.AUGHD_LOG]",microtime(true)));
//실행시간 검사
for($j=1;$j<sizeof($_RTIME);$j++){
	$log->debug( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) $log->debug( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

$log->info("Control___________________________end");
$log->close(); unset($log);
?>
