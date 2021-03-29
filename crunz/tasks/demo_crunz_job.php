<?php

//외부 변수
$BATCH_SEQ = intval( explode("=", $argv[1])[1] );
if(!is_numeric($BATCH_SEQ))exit;

echo 111 . PHP_EOL;

$CFG = require_once(__DIR__ . '/../../../common/include/incConfig.php');//CG CONFIG

print_r($CFG);
//exit;
if(!require_once(__DIR__ . "/../../../common/include/incUtil.php"))die("require incUtil fail.");
if(!require_once(__DIR__ . "/../../../common/include/incSec.php"))die("require incSec fail.");
if(!require_once(__DIR__ . "/../../../common/include/incDB.php"))die("require incDB fail.");

require_once(__DIR__ . "/../../../lib/php/vendor/autoload.php");

//배치 정보 불러오기
$obj = $CFG["CFG_DB"]["RDCOMMON"];
$obj["PW"] = aesDecrypt($obj["PW"],$CFG["CFG_SEC_KEY"],$CFG["CFG_SEC_IV"]);  

//print_r($obj);
$db = getDbConnPlain($obj);

//print_r($db);


$REQ["BATCH_SEQ"] = $BATCH_SEQ;
$sql = "
select 
    BATCH_SEQ, SOURCE_SVRID, SOURCE_SQL, TARGET_SVRID, TARGET_SQL, CRON
    , SOURCE_OUT_COLS, TARGET_IN_COLTYPES
    , START_DT, END_DT 
from
    CMN_BATCH
where BATCH_SEQ = #{BATCH_SEQ} ";
$stmt = makeStmt($db,$sql,$coltype="i",$REQ);

//print_r($stmt);

if(!$stmt)ServerMsg("500","300","SQL makeStmt 실패 했습니다.". $db->errno . " -> " . $db->error);
if(!$stmt->execute())ServerMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
$x =  getStmtArray($stmt)[0];
print_r($x);
closeStmt($stmt);

//배치 실행 상태 업데이트(실행중 : R, 정상종료되면 : S, 비정상종료되면 : F)
$sql = " update CMN_BATCH set 
    STATUS = 'R', MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
    where BATCH_SEQ = #{BATCH_SEQ} ";
$stmt = makeStmt($db,$sql,$coltype="i",$REQ);
if(!$stmt)ServerMsg("500","300","SQL makeStmt 실패 했습니다.". $db->errno . " -> " . $db->error);
if(!$stmt->execute())ServerMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);



//echo 555 . PHP_EOL;

print_r($x);

$srcColsArray = explode(",", $x["SOURCE_OUT_COLS"]); // "콤마 구분자 데이터 소스"
$coltype = str_replace(" ", "", str_replace(",","", $x["TARGET_IN_COLTYPES"])); // "콤마 구분자 데이터 소스"

//print_r($srcColsArray);


//소스에서 데이터 가져오기
$srcObj = $CFG["CFG_DB"][$x["SOURCE_SVRID"]];
$srcObj["PW"] = aesDecrypt($srcObj["PW"],$CFG["CFG_SEC_KEY"],$CFG["CFG_SEC_IV"]);  

$srcDb = getDbConnPlain($srcObj);
$sql = $x["SOURCE_SQL"];
$srcStmt = makeStmt($srcDb,$sql,$coltype,$REQ);
if(!$srcStmt)ServerMsg("500","301","SQL makeStmt 실패 했습니다.");
if(!$srcStmt->execute())ServerMsg("500","101","stmt 실행 실패" . $srcDb->errno . " -> " . $srcDb->error);
//$srcArr =  getStmtArray($stmt);

echo 888 . PHP_EOL;


//타겟어 데이터 넣기
$targetObj = $CFG["CFG_DB"][$x["TARGET_SVRID"]];
$targetObj["PW"] = aesDecrypt($targetObj["PW"],$CFG["CFG_SEC_KEY"],$CFG["CFG_SEC_IV"]);  

$targetDb = getDbConnPlain($targetObj);
print_r($targetDb);

$sql = $x["TARGET_SQL"];

//echo "source size : " . count($srcArr) . PHP_EOL;
echo "coltype = " . $coltype . PHP_EOL;

$t = 1;
if($stmt instanceOf PDOStatement){
    //pdo 
    echo "pdo target go.............................." . PHP_EOL;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo ($t++) . PHP_EOL;
        $cols = array();
        for($u=0;$u<count($srcColsArray);$u++){
            $colNm = trim($srcColsArray[$u]);
            $cols[$colNm] = $row[$colNm];
        }
        echo "\tsql = " . $sql . PHP_EOL;

        print_r($cols);
        $targetStmt = makeStmt($targetDb,$sql,$coltype,$cols);
        if(!$targetStmt)ServerMsg("500","310","SQL makeStmt 실패 했습니다.");
        if(!$targetStmt->execute())ServerMsg("500","110","stmt 실행 실패" . $targetDb->errno . " -> " . $targetDb->error);
        closeStmt($targetStmt);
    }
}else{
    //mysqli
    echo "mysqli target go.............................." . PHP_EOL;
    $result = $srcStmt->get_result();
    while ($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        echo ($t++) . PHP_EOL;
        $cols = array();
        for($u=0;$u<count($srcColsArray);$u++){
            $colNm = trim($srcColsArray[$u]);
            $cols[$colNm] = $row[$colNm];
        }
        echo "\tsql = " . $sql . PHP_EOL;

        print_r($cols);
        $targetStmt = makeStmt($targetDb,$sql,$coltype,$cols);
        if(!$targetStmt)ServerMsg("500","310","SQL makeStmt 실패 했습니다.");
        if(!$targetStmt->execute())ServerMsg("500","110","stmt 실행 실패" . $targetDb->errno . " -> " . $targetDb->error);
        closeStmt($targetStmt);
    }
}

closeStmt($srcStmt);
closeDb($srcDb);

closeDb($targetDb);

//배치 실행 상태 업데이트(실행중 : R, 정상종료되면 : S, 비정상종료되면 : F)
$sql = " update CMN_BATCH set 
    STATUS = 'S', LAST_RUN = date_format(sysdate(),'%Y%m%d%H%i%s')
    , MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
    where BATCH_SEQ = #{BATCH_SEQ} ";
$stmt = makeStmt($db,$sql,$coltype="i",$REQ);

$stmt = makeStmt($db,$sql,$coltype="i",$REQ);
if(!$stmt)ServerMsg("500","300","SQL makeStmt 실패 했습니다.". $db->errno . " -> " . $db->error);
if(!$stmt->execute())ServerMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
closeDb($db);

?>