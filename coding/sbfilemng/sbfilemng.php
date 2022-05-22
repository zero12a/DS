<?php

require_once "../../../common/include/incUtil.php";
$sandboxRoot = "/data/www/d.s/coding/pjt1_sb";

$cmd            = isset($_POST["CMD"])? $_POST["CMD"] : $_GET["CMD"];
$path           = isset($_POST["PATH"])? $_POST["PATH"] : $_GET["PATH"];
$oldPath        = isset($_POST["OLDPATH"])? $_POST["OLDPATH"] : $_GET["OLDPATH"];
$fileNm         = isset($_POST["FILENM"])? $_POST["FILENM"] : $_GET["FILENM"];
$oldFileNm      = isset($_POST["OLDFILENM"])? $_POST["OLDFILENM"] : $_GET["OLDFILENM"];

if($path == "")$path = "/";
if(substr($path,-1,1) != "/") $path .=  "/";

$fullPath       = $sandboxRoot . $path . $fileNm;
if($oldPath =="")$oldPath = $path;
if($oldFileNm =="")$oldFileNm = $fileNm;
$oldFullPath    = $sandboxRoot . $oldPath . $oldFileNm;
$data           = isset($_POST["DATA"])? $_POST["DATA"] : $_GET["DATA"];
$oldData        = isset($_POST["OLDDATA"])? $_POST["OLDDATA"] : $_GET["OLDDATA"];

//cmd 
// folder : mkdir, rmdir, mvdir
// file : create, delete, rename, update, move, list
// init(load from fileStore), sync(sync to fileStore)
// list : full json file/folderlist
if($cmd == "list"){

    //echo "scandir = " . $sandboxRoot . $path . "<br>";
    $fileArray = scandir($sandboxRoot . $path); //배열 0=. 1=.. 2=여기부터 정상
    //echo "<pre>" . var_dump($fileArray) . "</pre>";

    $rtnArray = array();
    for($i=2;$i<count($fileArray);$i++){
        //echo "<br>"  . $sandboxRoot . $path  . $fileArray[$i];
        if(is_dir( $sandboxRoot . $path  . $fileArray[$i] )){
            $rtnArray[$i-2]["nm"] = $fileArray[$i];
            $rtnArray[$i-2]["dir"] = "Y";
            //echo " Y";
        }else{
            $rtnArray[$i-2]["nm"] = $fileArray[$i];
            $rtnArray[$i-2]["dir"] = "N";
            //echo " N";
        }
    }

    $json_pretty = json_encode($rtnArray, JSON_PRETTY_PRINT);
    echo $json_pretty;
    //echo "<pre>".$json_pretty."<pre/>";

}else if($cmd == "mkdir"){
    if($fileNm == ""){
        //echo "폴더 이름이 입력되지 않았습니다.";
        JsonMsg("500","510","폴더 이름이 입력되지 않았습니다.");
    }else if($path == ""){
        //echo "폴더 경로가 입력되지 않았습니다.";
        JsonMsg("500","520","폴더 경로가 입력되지 않았습니다.");
    }else{
        if(is_dir($fullPath)){
            //echo "이미 동일이름의 폴더가 존재합니다.";
            JsonMsg("500","530","이미 동일이름의 폴더가 존재합니다.");
        }else if(!mkdir($fullPath, 0777)) {
            //echo "폴더 생성에 실패했습니다.";
            JsonMsg("500","540","폴더 생성에 실패했습니다.");
        }else{
            //echo "폴더 생성에 성공했습니다.";
            JsonMsg("200","200","폴더 생성에 성공했습니다.");
        }
    }
}else if($cmd == "mvdir"){
    if($fileNm == ""){
        //echo "이동할 폴더 이름이 입력되지 않았습니다.";
        JsonMsg("500","510","이동할 폴더 이름이 입력되지 않았습니다.");
    }else if($path == ""){
        //echo "이동할 폴더 경로가 입력되지 않았습니다.";
        JsonMsg("500","510","이동할 폴더 경로가 입력되지 않았습니다.");
    }else if($oldFileNm == ""){
        //echo "이동시킬 폴더 이름이 입력되지 않았습니다.";
        JsonMsg("500","510","이동시킬 폴더 이름이 입력되지 않았습니다.");
    }else if($oldPath == ""){
        //echo "이동시킬 폴더 경로가 입력되지 않았습니다.";
        JsonMsg("500","510","이동시킬 폴더 경로가 입력되지 않았습니다.");
    }else{
        if(!is_dir($oldFullPath)){
            //echo "이동시킬 기존 폴더가 존재하지 않습니다.($oldFullPath)";
            JsonMsg("500","510","이동시킬 기존 폴더가 존재하지 않습니다.($oldFullPath)");
        }else if(is_dir($fullPath)){
            //echo "이미할 경로에 동일이름의 폴더가 존재합니다.";
            JsonMsg("500","510","이미할 경로에 동일이름의 폴더가 존재합니다.");
        }else if(!rename($oldFullPath, $fullPath)) {
            //echo "폴더 이동에 실패했습니다.";
            JsonMsg("500","510","폴더 이동에 실패했습니다.");
        }else{
            //echo "폴더 이동에 성공했습니다.";
            JsonMsg("200","200","폴더 이동에 성공했습니다.");
        }
    }
}else if($cmd == "rmdir"){
    if($fileNm == ""){
        //echo "삭제할 폴더 이름이 입력되지 않았습니다.";
        JsonMsg("500","510","삭제할 폴더 이름이 입력되지 않았습니다.");
    }else if($path == ""){
        //echo "삭제할 경로가 입력되지 않았습니다.";
        JsonMsg("500","510","삭제할 경로가 입력되지 않았습니다.");
    }else{
        if(!is_dir($fullPath)){
            //echo "삭제할 경로에 해당 폴더가 존재하지 않습니다.($fullPath)";
            JsonMsg("500","510","삭제할 경로에 해당 폴더가 존재하지 않습니다.($fullPath)");
        }else{
            rrmdir($fullPath);//하위경로까지 일괄 삭제
            //echo "폴더를 일괄 삭제했습니다.";
            JsonMsg("200","510","폴더를 일괄 삭제했습니다.");
        }
    }
}else if($cmd == "create"){
    if($fileNm == ""){
        //echo "파일 이름이 입력되지 않았습니다.";
        JsonMsg("500","510","파일 이름이 입력되지 않았습니다.");
    }else if($path == ""){
        //echo "파일 경로가 입력되지 않았습니다.";
        JsonMsg("500","510","파일 경로가 입력되지 않았습니다.");
    }else if(file_exists($fullPath)){
        //echo "같은 이름의 파일이 존재($fullPath)";
        JsonMsg("500","510","같은 이름의 파일이 존재($fullPath)");
    }else{
        $fh = fopen($fullPath, "w");
        if(!$fh){
            //echo "해당 폴더에 파일쓰기 권한이 없습니다";
            JsonMsg("500","510","해당 폴더에 파일쓰기 권한이 없습니다");
        }else{
            fwrite($fh, $data);
            fclose($fh);
            //echo "파일 생성 성공했습니다.";
            JsonMsg("200","510","파일 생성 성공했습니다.");
        }
    }
}else if($cmd == "update"){
    if($fileNm == ""){
        echo "파일 이름이 입력되지 않았습니다.";
    }else if($path == ""){
        echo "파일 경로가 입력되지 않았습니다.";
    }else if(!file_exists($fullPath)){
        echo "업데이트할 파일이 존재하지 않습니다.";
    }else{
        $fh = fopen($fullPath, "w");
        if(!$fh){
            echo "해당 폴더에 파일쓰기 권한이 없습니다";
        }else{
            fwrite($fh, $data);
            fclose($fh);
            echo "파일 업데이트 성공했습니다.";
        }
    }
}else if($cmd == "delete"){
    if(!file_exists($fullPath)){
        //echo "삭제할 파일이 존재하지 않습니다.";
        JsonMsg("500","510","삭제할 파일이 존재하지 않습니다.($fullPath)");
    }else{
        if(!unlink($fullPath)){
            //echo "해당 파일을 삭제에 실패했습니다.";
            JsonMsg("500","510","해당 파일을 삭제에 실패했습니다.");
        }else{
            //echo "파일 삭제 성공했습니다.";
            JsonMsg("200","200","파일 삭제 성공했습니다.");
        }
    }
}else if($cmd == "rename"){
    if($fileNm == ""){
        //echo "신규 파일 이름이 입력되지 않았습니다.";
        JsonMsg("500","510","신규 파일 이름이 입력되지 않았습니다.");
    }else if($oldFileNm == ""){
        //echo "기존 파일 이름이 입력되지 않았습니다.($oldFileNm)";
        JsonMsg("500","520","기존 파일 이름이 입력되지 않았습니다.($oldFileNm)");
    }else if($path == ""){
        //echo "파일 경로가 입력되지 않았습니다.";
        JsonMsg("500","530","파일 경로가 입력되지 않았습니다.");
    }else if(!file_exists($oldFullPath)){
        //echo "이름 변경할 기존 파일이 존재하지 않습니다.($oldFullPath)";
        JsonMsg("500","540","이름 변경할 기존 파일이 존재하지 않습니다.($oldFullPath)");
    }else if(file_exists($fullPath)){
        //echo "신규 변경할 이름이 이미 존재합니다.";
        JsonMsg("500","550","신규 변경할 이름이 이미 존재합니다.");
    }else{
        if(!rename($oldFullPath, $fullPath)){
            //echo "해당 파일을 이름변경에 실패했습니다.";
            JsonMsg("500","560","해당 파일을 이름변경에 실패했습니다.");
        }else{
            //echo "파일 이름변경을 성공했습니다.";
            JsonMsg("200","200", "파일 이름변경을 성공했습니다.");
        }
    }
}else if($cmd == "move"){
    if(!file_exists($oldFullPath)){
        echo "이동할 기존 파일이 존재하지 않습니다.";
    }else if(file_exists($fullPath)){
        echo "이동할 경로에 동일 파일 이름이 이미 존재합니다.";
    }else{
        if(!rename($oldFullPath, $fullPath)){
            echo "해당 파일을 이동에 실패했습니다.";
        }else{
            echo "파일 이동에 성공했습니다.";
        }
    }
}else{
    echo "처리할 명령어가 없습니다.(cmd is empty)";
}


function rrmdir($src) {
    $dir = opendir($src);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            $full = $src . '/' . $file;
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
}

?>