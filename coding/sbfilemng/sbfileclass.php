<?php

class sbFileService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("dbfileService-__construct");

        $db["HOST"] = "172.17.0.1";
        $db["ID"] = "cg";
        $db["PW"] = "cg1234qwer";
        $db["DBNM"] = "CODESCHOOL";
        $db["PORT"] = "4306";
		$db["DRIVER"] = "PDO_MYSQL";

        $this->DB = getDbConnPlain($db);
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("dbfileService-__destruct");


		if($this->DB)closeDb($this->DB);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("dbfileService-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("dbfileService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("dbfileService-goG1Searchall________________________end");
	}



	//테이블목록, 조회
	public function list($REQ){
		global $log;
        $log->info("dbfileService-list________________________start");

        //$blob = fopen($filePath, 'rb');
        
		//var_dump($REQ);

        $sql = "
        select 
			SFILE_SEQ as seq,
			NM as nm, 
			FOLDER_YN as dir
		from SANDBOX_FILE
		where SANDBOX_SEQ = :SANDBOX_SEQ and PATH = :PATH
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);
        $stmt->bindParam(':PATH', $REQ["PATH"]);
        
        //$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
        if(!$stmt->execute())JsonMsg("500","600","create()에서 execute()실패했습니다."); 

		$rtnArray = $stmt->fetchAll(PDO::FETCH_CLASS);
		

        //fclose($blob);

        $log->info("dbfileService-list________________________end");
		return $rtnArray;
	}

	//테이블목록, 조회
	public function getcode($REQ){
		global $log;
		$log->info("dbfileService-getcode________________________start");

		//$blob = fopen($filePath, 'rb');
		
		//var_dump($REQ);

		$sql = "
		select FILE_DATA
		from SANDBOX_FILE
		where SANDBOX_SEQ = :SANDBOX_SEQ and DEGREE_SEQ = :DEGREE_SEQ and SFILE_SEQ = :SFILE_SEQ
		";
		$stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
		$stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);
		$stmt->bindParam(':DEGREE_SEQ', $REQ["DEGREE_SEQ"]);
		$stmt->bindParam(':SFILE_SEQ', $REQ["SFILE_SEQ"]);

		//$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
		if(!$stmt->execute())JsonMsg("500","600","getcode()에서 execute()실패했습니다."); 

		$rtnArray = $stmt->fetchAll(PDO::FETCH_CLASS);
		

		//fclose($blob);

		$log->info("dbfileService-getcode________________________end");
		return $rtnArray;
	}


	//테이블목록, 조회
	public function create($REQ){
		global $log;
        $log->info("dbfileService-create________________________start");

        //$blob = fopen($filePath, 'rb');
        
        $sql = "
        insert into SANDBOX_FILE(
            DEGREE_SEQ, SANDBOX_SEQ, PATH, NM, FOLDER_YN
            , FILE_HASH, FILE_DATA, ADD_DT
        )values(
            :DEGREE_SEQ, :SANDBOX_SEQ, :PATH, :NM, 'N'
            , :FILE_HASH, '', date_format(sysdate(),'%Y%m%d%H%i%s')
        )
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':DEGREE_SEQ', $REQ["DEGREE_SEQ"]);
        $stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);
        $stmt->bindParam(':PATH', $REQ["PATH"]);
        $stmt->bindParam(':NM', $REQ["NM"]);
        $stmt->bindParam(':FILE_HASH', $REQ["FILE_HASH"]);

        
        //$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
        if(!$stmt->execute())JsonMsg("500","600","create()에서 execute()실패했습니다."); 
		$rtnVal = $this->DB->lastInsertId();

        //fclose($blob);

        $log->info("dbfileService-create________________________end");
		return $rtnVal;
	}
	

	//테이블목록, 조회
	public function multiupload($REQ){
		global $log;
        $log->info("dbfileService-multiupload________________________start");

        //$blob = fopen($filePath, 'rb');
        
        $sql = "
        insert into SANDBOX_FILE(
            DEGREE_SEQ, SANDBOX_SEQ, PATH, NM, FOLDER_YN
            , FILE_HASH, FILE_DATA, ADD_DT
        )values(
            :DEGREE_SEQ, :SANDBOX_SEQ, :PATH, :NM, 'N'
            , :FILE_HASH, :FILE_DATA, date_format(sysdate(),'%Y%m%d%H%i%s')
        )
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':DEGREE_SEQ', $REQ["DEGREE_SEQ"]);
        $stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);
        $stmt->bindParam(':PATH', $REQ["PATH"]);
        $stmt->bindParam(':NM', $REQ["NM"]);
        $stmt->bindParam(':FILE_HASH', $REQ["FILE_HASH"]);
        
        $stmt->bindParam(':FILE_DATA', $REQ["FILE_DATA"], PDO::PARAM_LOB);

        if(!$stmt->execute())JsonMsg("500","600","multiupload()에서 execute()실패했습니다."); 
		$rtnVal = $this->DB->lastInsertId();

        //fclose($blob);

        $log->info("dbfileService-multiupload________________________end");
		return $rtnVal;
	}

	//테이블목록, 조회
	public function rename($REQ){
		global $log;
        $log->info("dbfileService-rename________________________start");

        //$blob = fopen($filePath, 'rb');
        //var_dump($REQ);

		//100 본인 객체 정보 변경하기
        $sql = "
        update
			SANDBOX_FILE
		set 
			NM = :NM,
			MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
		where SFILE_SEQ = :SFILE_SEQ and SANDBOX_SEQ = :SANDBOX_SEQ
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':NM', $REQ["NM"]);
        $stmt->bindParam(':SFILE_SEQ', $REQ["SFILE_SEQ"]);
        $stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);

        
        //$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
        if(!$stmt->execute())JsonMsg("500","600","create()에서 execute()실패했습니다."); 

        //fclose($blob);

        $log->info("dbfileService-rename________________________end");
		return $rtnVal;
	}


	//테이블목록, 조회
	public function mvdir($REQ){
		global $log;
        $log->info("dbfileService-mvdir________________________start");

        //$blob = fopen($filePath, 'rb');
        //var_dump($REQ);

		//100 본인 객체 정보 변경하기
        $sql = "
        update
			SANDBOX_FILE
		set 
			NM = :NM,
			MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
		where SFILE_SEQ = :SFILE_SEQ and SANDBOX_SEQ = :SANDBOX_SEQ
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':NM', $REQ["NM"]);
        $stmt->bindParam(':SFILE_SEQ', $REQ["SFILE_SEQ"]);
        $stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);

        
        //$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
        if(!$stmt->execute())JsonMsg("500","600","create()에서 execute()실패했습니다."); 
		$stmt = null;


		//200 하위 폴더 정보 변경하기
        $sql = "
        update
			SANDBOX_FILE
		set 
			PATH = replace(PATH,:OLDPATH, :PATH)
			, MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
		where PATH like concat(:OLDPATH,'%')
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':OLDPATH', $REQ["OLDPATH"]);
        $stmt->bindParam(':PATH', $REQ["PATH"]);
        
        //$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
        if(!$stmt->execute())JsonMsg("500","600","create()에서 execute()실패했습니다."); 
		$stmt = null;
	
        //fclose($blob);

        $log->info("dbfileService-mvdir________________________end");
		return $rtnVal;
	}

	//테이블목록, 조회
	public function update($REQ){
		global $log;
        $log->info("dbfileService-update________________________start");

        //$blob = fopen($filePath, 'rb');
        //var_dump($REQ);

        $sql = "
        update
			SANDBOX_FILE
		set 
			FILE_DATA = :FILE_DATA,
			MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
		where SFILE_SEQ = :SFILE_SEQ and SANDBOX_SEQ = :SANDBOX_SEQ and DEGREE_SEQ = :DEGREE_SEQ
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':FILE_DATA', $REQ["FILE_DATA"], PDO::PARAM_LOB);
        $stmt->bindParam(':SFILE_SEQ', $REQ["SFILE_SEQ"]);
        $stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);
        $stmt->bindParam(':DEGREE_SEQ', $REQ["DEGREE_SEQ"]);
        
        //$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
        if(!$stmt->execute())JsonMsg("500","600","update()에서 execute()실패했습니다."); 
	
        //fclose($blob);

        $log->info("dbfileService-update________________________end");
		return $rtnVal;
	}


	//테이블목록, 조회
	public function rmdir($REQ){
		global $log;
        $log->info("dbfileService-rmdir________________________start");

        //$blob = fopen($filePath, 'rb');
        //var_dump($REQ);

        $sql = "
        delete from 
			SANDBOX_FILE
		where 
		( 
			( PATH = :PATH and NM = :NM and FOLDER_YN = 'Y' ) /*자기 자신 폴더 삭제*/
			or
			PATH like concat(:PATH,:NM,'/%') /*하위객체 모두 삭제*/
		)
		and SANDBOX_SEQ = :SANDBOX_SEQ and DEGREE_SEQ = :DEGREE_SEQ
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':PATH', $REQ["PATH"]);
		$stmt->bindParam(':NM', $REQ["NM"]);
		$stmt->bindParam(':PATH', $REQ["PATH"]);
		$stmt->bindParam(':NM', $REQ["NM"]);
        $stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);
        $stmt->bindParam(':DEGREE_SEQ', $REQ["DEGREE_SEQ"]);
        
        //$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
        if(!$stmt->execute())JsonMsg("500","600","rmdir()에서 execute()실패했습니다."); 
	
        //fclose($blob);

        $log->info("dbfileService-rmdir________________________end");
		return true;
	}


	//테이블목록, 조회
	public function delete($REQ){
		global $log;
        $log->info("dbfileService-delete________________________start");

        //$blob = fopen($filePath, 'rb');
        //var_dump($REQ);

        $sql = "
        delete from 
			SANDBOX_FILE
		where SFILE_SEQ = :SFILE_SEQ and SANDBOX_SEQ = :SANDBOX_SEQ
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':SFILE_SEQ', $REQ["SFILE_SEQ"]);
        $stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);

        
        //$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
        if(!$stmt->execute())JsonMsg("500","600","delete()에서 execute()실패했습니다."); 
	
        //fclose($blob);

        $log->info("dbfileService-delete________________________end");
		return true;
	}


	//테이블목록, 조회
	public function mkdir($REQ){
		global $log;
        $log->info("dbfileService-mkdir________________________start");

        //$blob = fopen($filePath, 'rb');
		//var_dump($REQ);
        
        $sql = "
        insert into SANDBOX_FILE(
            DEGREE_SEQ, SANDBOX_SEQ, PATH, NM, FOLDER_YN
            , FILE_HASH, FILE_DATA, ADD_DT
        )values(
            :DEGREE_SEQ, :SANDBOX_SEQ, :PATH, :NM, 'Y'
            , :FILE_HASH, '', date_format(sysdate(),'%Y%m%d%H%i%s')
        )
        ";
        $stmt = $this->DB->prepare($sql);

		//var_dump($REQ);
        $stmt->bindParam(':DEGREE_SEQ', $REQ["DEGREE_SEQ"]);
        $stmt->bindParam(':SANDBOX_SEQ', $REQ["SANDBOX_SEQ"]);
        $stmt->bindParam(':PATH', $REQ["PATH"]);
        $stmt->bindParam(':NM', $REQ["NM"]);
        $stmt->bindParam(':FILE_HASH', $REQ["FILE_HASH"]);

        
        //$stmt->bindParam(':FILE_DATA', $blob, PDO::PARAM_LOB);
        if(!$stmt->execute())JsonMsg("500","600","create()에서 execute()실패했습니다."); 
		$rtnVal = $this->DB->lastInsertId();

        //fclose($blob);

        $log->info("dbfileService-mkdir________________________end");
		return $rtnVal;
	}

	//테이블목록, 엑셀다운로드
	public function goG2Excel(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("DBDEPLOYService-goG2Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("DBDEPLOYService-goG2Excel________________________end");
	}
	//테이블상세, 조회
	public function goG3Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("DBDEPLOYService-goG3Search________________________start");
//FORMVIEW SEARCH
		$grpId="G3";
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array();
		$FORMVIEW["SQL"] = array();
	// SQL LOOP
		// dtlTable
		array_push($FORMVIEW["SQL"], $this->DAO->dtlTable($REQ)); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearchArray($FORMVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireFormview - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeFormviewSearchJsonArray($FORMVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("DBDEPLOYService-goG3Search________________________end");
	}
}
                                                             
?>
