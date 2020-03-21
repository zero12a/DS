//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_USERDEF = "iconmngController?CTLGRP=G1&CTLFNC=USERDEF";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "iconmngController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "iconmngController?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "iconmngController?CTLGRP=G1&CTLFNC=RESET";
// 변수 선언	
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_USERDEF = "iconmngController?CTLGRP=G2&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G2_SEARCH = "iconmngController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "iconmngController?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_RELOAD = "iconmngController?CTLGRP=G2&CTLFNC=RELOAD";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//디테일 변수 초기화	

var isBindEvent_G3 = false; //바인드폼 구성시 이벤트 부여여부
//폼뷰 컨트롤러 경로
var url_G3_USERDEF = "iconmngController?CTLGRP=G3&CTLFNC=USERDEF";
//폼뷰 컨트롤러 경로
var url_G3_SAVE = "iconmngController?CTLGRP=G3&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G3_RELOAD = "iconmngController?CTLGRP=G3&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_G3_NEW = "iconmngController?CTLGRP=G3&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_G3_MODIFY = "iconmngController?CTLGRP=G3&CTLFNC=MODIFY";
//폼뷰 컨트롤러 경로
var url_G3_DELETE = "iconmngController?CTLGRP=G3&CTLFNC=DELETE";
//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "iconmngController?CTLGRP=G3&CTLFNC=SEARCH";
var obj_G3_ICONSEQ;   // seq 글로벌 변수 선언
var obj_G3_IMGNM;   // IMGNM 글로벌 변수 선언
var obj_G3_IMGSIZE;   // IMGSIZE 글로벌 변수 선언
var obj_G3_IMGSVRNM;   // IMGSVRNM 글로벌 변수 선언
var obj_G3_IMGHASH;   // IMGHASH 글로벌 변수 선언
var obj_G3_IMGTYPE;   // IMGTYPE 글로벌 변수 선언
var obj_G3_CODEMIRROR;   // CODEMIRROR 글로벌 변수 선언
var obj_G3_ICONFILE;   // ICONFILE 글로벌 변수 선언
var obj_G3_ADDDT;   // 생성일 글로벌 변수 선언
	var codeMirrorFontSizeG3Codemirror = 11; // CODEMIRROR

//CODEMIRROR
function changeCodemirrorFontSizeG3Codemirror(sizeCmd){
	alog("changeCodemirrorFontSizeG3Codemirror..........start " + sizeCmd);

	if(sizeCmd == "+"){
		codeMirrorFontSizeG3Codemirror  = codeMirrorFontSizeG3Codemirror  + 2;
	}else{
		codeMirrorFontSizeG3Codemirror  = codeMirrorFontSizeG3Codemirror  - 2;
	}

	$(".CodeMirror").css('font-size',codeMirrorFontSizeG3Codemirror  + "px");

	obj_G3_CODEMIRROR.refresh();
	alog("changeCodemirrorFontSizeG3Codemirror..........end");   
}
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
	G2_INIT();	
	G3_INIT();	
      feather.replace();
	alog("initBody()-----------------------end");
} //initBody()	
//팝업띄우기		
	//팝업창 오픈요청
function goGridPopOpen(tGrpId,tRowId,tColIndex,tValue,tText){
	alog("goGridPopOpen()............. tGrpId = " + tGrpId + ", tRowId = " + tRowId + ", tColIndex = " + tColIndex + ", tValue = " + tValue + ", tText = " + tText);
	
	tColId = mygridG2.getColumnId(tColIndex);
	
	//PGMGRP ,  	
}
function goFormPopOpen(tGrpId, tColId, tColId_Nm){
	alog("goFormviewPopOpen()............. tGrpId = " + tGrpId + ", tColId = " + tColId + ", tColId_Nm = " +tColId_Nm );
	
	tColId_Val = $("#" + tColId).val();
	tColId_Nm_Text = $("#" + tColId_Nm).text();
	//PGMGRP ,  	
}// goFormviewPopOpen
//부모창 리턴용//팝업창에서 받을 내용
function popReturn(tGrpId,tRowId,tColId,tBtnNm,tJsonObj){
	//alert("popReturn");
		//, 

}//popReturn
//그룹별 초기화 함수	
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");
	//각 폼 오브젝트들 초기화
  alog("G1_INIT()-------------------------end");
}

	// 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

	//그리드 초기화
	mygridG2 = new dhtmlXGridObject('gridG2');
	mygridG2.setDateFormat("%Y%m%d");
	mygridG2.setImagePath(CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
	mygridG2.setUserData("","gridTitle","G2 : "); //글로별 변수에 그리드 타이블 넣기
	//헤더초기화
	mygridG2.setHeader("seq,IMGNM,IMGSVRNM,IMGSIZE,IMGHASH,IMGTYPE,CODEMIRROR,생성일");
	mygridG2.setColumnIds("ICONSEQ,IMGNM,IMGSVRNM,IMGSIZE,IMGHASH,IMGTYPE,CODEMIRROR,ADDDT");
	mygridG2.setInitWidths("70,70,70,70,80,80,200,100");
	mygridG2.setColTypes("ro,ro,ro,ro,ro,co,ro,ro");
	//가로 정렬	
	mygridG2.setColAlign("left,left,left,left,left,left,left,left");
	mygridG2.setColSorting("int,str,str,int,str,int,str,str");	//렌더링	
	mygridG2.enableSmartRendering(false);
	mygridG2.enableMultiselect(true);
	//mygridG2.setColValidators("G2_ICONSEQ,G2_IMGNM,G2_IMGSVRNM,G2_IMGSIZE,G2_IMGHASH,G2_IMGTYPE,G2_CODEMIRROR,G2_ADDDT");
	mygridG2.splitAt(0);//'freezes' 0 columns 
	mygridG2.init();

	mygridG2.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG2.enableBlockSelection(true);
		mygridG2.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG2.editor){
				mygridG2.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG2.copyBlockToClipboard();

					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG2.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG2.getRowId(j);
						RowEditStatus = mygridG2.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG2.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG2.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : seq초기화	
		 // IO : IMGNM초기화	
		 // IO : IMGSVRNM초기화	
		 // IO : IMGSIZE초기화	
		 // IO : IMGHASH초기화	
		setCodeCombo("GRID",mygridG2.getCombo(mygridG2.getColIndexById("IMGTYPE")),"IMAGETYPE"); // IO : IMGTYPE초기화	
		 // IO : CODEMIRROR초기화	
		 // IO : 생성일초기화	
	//onCheck
		mygridG2.attachEvent("onCheck",function(rowId, cellInd, state){
			alog("mygridG2  onCheck ------------------start");
			alog("	rowId=" + rowId + ", cellInd=" + cellInd + ", state=" + state);

			RowEditStatus = mygridG2.getUserData(rowId,"!nativeeditor_status");
			alog("	RowEditStatus=" + RowEditStatus);
			//[일반 체크] 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				if(RowEditStatus == ""){
					mygridG2.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG2.setRowTextBold(rowId);
					mygridG2.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트 (자식 그룹이 있을때만 호출)
		mygridG2.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG2.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect20(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG2json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG2json && popG2json.CD){
				goOpenerReturn(popG2json);
				return;
			}
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
				', "G2-ICONSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ICONSEQ")).getValue()) + '"' +
			', "G2-IMGNM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IMGNM")).getValue()) + '"' +
			', "G2-IMGSVRNM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IMGSVRNM")).getValue()) + '"' +
			', "G2-IMGSIZE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IMGSIZE")).getValue()) + '"' +
			', "G2-ADDDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADDDT")).getValue()) + '"' +
			', "G2-IMGHASH" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IMGHASH")).getValue()) + '"' +
			', "G2-IMGTYPE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IMGTYPE")).getValue()) + '"' +
			', "G2-CODEMIRROR" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("CODEMIRROR")).getValue()) + '"' +
			'}');
		lastinputG3 = new HashMap(); // 
		lastinputG3.set("__ROWID",rowID);
		lastinputG3.set("G2-ICONSEQ", mygridG2.cells(rowID,mygridG2.getColIndexById("ICONSEQ")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG3.set("G2-IMGNM", mygridG2.cells(rowID,mygridG2.getColIndexById("IMGNM")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG3.set("G2-IMGSVRNM", mygridG2.cells(rowID,mygridG2.getColIndexById("IMGSVRNM")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG3.set("G2-IMGSIZE", mygridG2.cells(rowID,mygridG2.getColIndexById("IMGSIZE")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG3.set("G2-ADDDT", mygridG2.cells(rowID,mygridG2.getColIndexById("ADDDT")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG3.set("G2-IMGHASH", mygridG2.cells(rowID,mygridG2.getColIndexById("IMGHASH")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG3.set("G2-IMGTYPE", mygridG2.cells(rowID,mygridG2.getColIndexById("IMGTYPE")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG3.set("G2-CODEMIRROR", mygridG2.cells(rowID,mygridG2.getColIndexById("CODEMIRROR")).getValue().replace(/&amp;/g, "&")); // 
			G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 
		});
	//onEditCell 이벤트
	mygridG2.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
		alog("mygridG2  onEditCell ------------------start");
		alog("	stage : " + stage + ", rId : " + rId + ", cInd : " + cInd + ", nValue : " + nValue + ", oValue : " + oValue);

		RowEditStatus = mygridG2.getUserData(rId,"!nativeeditor_status");
		alog("	RowEditStatus = " + RowEditStatus);

		//체크박스 아닌 일반 컬럼
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG2.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG2.setRowTextBold(rId);
                }
                mygridG2.cells(rId,cInd).cell.wasChanged = true;
            }

            return true;
	});
	alog("G2_INIT()-------------------------end");
}
//디테일 초기화	
// 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");





setCodeCombo("FORMVIEW",$("#G3-IMGTYPE"),"IMAGETYPE");



	//컬럼 초기화
	//ICONSEQ, seq 초기화	
	$("#G3-ICONSEQ").attr("readonly",true);
	//IMGNM, IMGNM 초기화	
	//IMGSIZE, IMGSIZE 초기화	
	//IMGSVRNM, IMGSVRNM 초기화	
	//IMGHASH, IMGHASH 초기화	
		//코드 미러 초기화
        obj_G3_CODEMIRROR = CodeMirror.fromTextArea(document.getElementById('codeMirror_G3-CODEMIRROR'), {
            mode: "text/x-sql",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineWrapping: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
			hintOptions: {tables: {
			  users: {name: null, score: null, birthDate: null},
			  countries: {name: null, population: null, size: null}
			}}
        });
		obj_G3_CODEMIRROR .setSize("200px","px");
	//ICONFILE, ICONFILE 초기화	
	//ADDDT, 생성일 초기화	
  alog("G3_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//사용자정의함수 : 사용자정의
function G1_USERDEF(token){
	alog("G1_USERDEF-----------------start");

	alog("G1_USERDEF-----------------end");
}
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//, 저장	
function G1_SAVE(){
 alog("G1_SAVE-------------------start");
	//FormData parameter에 담아줌	
	sendFormData = new FormData($("#condition")[0]);	//G1 getparams	
	$.ajax({	
		type : "POST",
		url : url_G1_SAVE  ,
		data : sendFormData,
		processData: false,
		contentType: false,
		async: false,
		success: function(tdata){
			alog("   json return----------------------");
			alog("   json data : " + tdata);
			data = jQuery.parseJSON(tdata);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("[G1] Ajax http 500 error ( " + error + " )");
			alog("[G1] Ajax http 500 error ( " + error + " )");
		}
	});
	alog("G1_SAVE-------------------end");	
}
//사용자정의함수 : 사용자정의
function G2_USERDEF(token){
	alog("G2_USERDEF-----------------start");

	alog("G2_USERDEF-----------------end");
}
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}








    //그리드 조회()	
    function G2_SEARCH(tinput,token){
        alog("G2_SEARCH()------------start");

		var tGrid = mygridG2;

        //그리드 초기화
        tGrid.clearAll();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SEARCH+"&TOKEN=" + token + " &G2_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG2 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG2Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[] Ajax http 500 error ( " + error + " )",3);
                alog("[] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }

	function G2_SAVE(token){
	alog("G2_SAVE()------------start");
	tgrid = mygridG2;

	tgrid.setSerializationLevel(true,false,false,false,true,true);
	var myXmlString = tgrid.serialize();
	//post 만들기
	sendFormData = new FormData($("#condition")[0]);

	//상속받은거 전달할수 있게 합치기
	if(typeof lastinputG2 != "undefined"){
		var tKeys = lastinputG2.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],lastinputG2.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ lastinputG2.get(tKeys[i])); 
		}
	}
	sendFormData.append("G2-XML" , myXmlString);//폼뷰 G3는 params 객체에 직접 입력	
	//폼에 파일 유무 : Y
	sendFormData.append("G3-CTLCUD",$("#G3-CTLCUD").val());
	sendFormData.append("G3-ICONSEQ",$("#G3-ICONSEQ").val());	//seq 전송객체에 넣기
	sendFormData.append("G3-IMGNM",$("#G3-IMGNM").val());	//IMGNM 전송객체에 넣기
	sendFormData.append("G3-IMGSIZE",$("#G3-IMGSIZE").val());	//IMGSIZE 전송객체에 넣기
	sendFormData.append("G3-IMGSVRNM",$("#G3-IMGSVRNM").val());	//IMGSVRNM 전송객체에 넣기
	sendFormData.append("G3-IMGHASH",$("#G3-IMGHASH").val());	//IMGHASH 전송객체에 넣기
	sendFormData.append("G3-IMGTYPE",$("#G3-IMGTYPE").val());	//IMGTYPE 전송객체에 넣기
	sendFormData.append("G2-CODEMIRROR",obj_G2_CODEMIRROR.getValue()); //CODEMIRROR
	if($("#G3_ICONFILE").val() != ""){
		sendFormData.append("G3-ICONFILE",$("input[name=G3-ICONFILE]")[0].files[0]);
	}
	sendFormData.append("G3-ADDDT",$("#G3-ADDDT").val());	//생성일 전송객체에 넣기

	$.ajax({
		type : "POST",
		url : url_G2_SAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
		dataType: "json",
		async: false,
		success: function(data){
			alog("   json return----------------------");
			alog("   json data : " + data);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("Ajax http 500 error ( " + error + " )");
			alog("Ajax http 500 error ( " + error + " )");
		}
	});
	
	alog("G2_SAVE()------------end");
}
//G3_SAVE
//IO_FILE_YN = V/, G/Y	
//IO_FILE_YN = Y	
function G3_SAVE(token){	
	alog("G3_SAVE---------------start");

	if( !( $("#G3-CTLCUD").val() == "C" || $("#G3-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//post 만들기
	sendFormData = new FormData($("#condition")[0]);

	//상속받은거 전달할수 있게 합치기
	if(typeof lastinputG3 != "undefined"){
		var tKeys = lastinputG3.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],lastinputG3.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ lastinputG3.get(tKeys[i])); 
		}
	}
	//컨디션 radio, checkbox 만 재지정
	//GRP SVC LOOP
//폼뷰 G3는 params 객체에 직접 입력	
	//폼에 파일 유무 : Y
	sendFormData.append("G3-CTLCUD",$("#G3-CTLCUD").val());
	sendFormData.append("G3-ICONSEQ",$("#G3-ICONSEQ").val());	//seq 전송객체에 넣기
	sendFormData.append("G3-IMGNM",$("#G3-IMGNM").val());	//IMGNM 전송객체에 넣기
	sendFormData.append("G3-IMGSIZE",$("#G3-IMGSIZE").val());	//IMGSIZE 전송객체에 넣기
	sendFormData.append("G3-IMGSVRNM",$("#G3-IMGSVRNM").val());	//IMGSVRNM 전송객체에 넣기
	sendFormData.append("G3-IMGHASH",$("#G3-IMGHASH").val());	//IMGHASH 전송객체에 넣기
	sendFormData.append("G3-IMGTYPE",$("#G3-IMGTYPE").val());	//IMGTYPE 전송객체에 넣기
	sendFormData.append("G3-CODEMIRROR",obj_G3_CODEMIRROR.getValue()); //CODEMIRROR
	if($("#G3_ICONFILE").val() != ""){
		sendFormData.append("G3-ICONFILE",$("input[name=G3-ICONFILE]")[0].files[0]);
	}
	sendFormData.append("G3-ADDDT",$("#G3-ADDDT").val());	//생성일 전송객체에 넣기

	$.ajax({
		type : "POST",
		url : url_G3_SAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
		success: function(tdata){
			alog(tdata);
			data = jQuery.parseJSON(tdata);
			//alert(data);
			if(data && data.RTN_CD == "200"){

				if(typeof(data.GRP_DATA) == "undefined" || data.GRP_DATA[0] == null || typeof(data.GRP_DATA[0].RTN_DATA) == "undefined"){
					msgNotice("오류를 발생하지 않았으나, 처리 내역이 없습니다.(GRP_DATA is null, SQL미등록)",1);
				}else{
					affectedRows = data.GRP_DATA[0].RTN_DATA;
					msgNotice("정상적으로 저장되었습니다. [영향받은건수:" + affectedRows + "]",1);
				}

			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
			}
		},
		error: function(error){
			alog("Error:");
			alog(error);
		}
	});
}function G3_MODIFY(){
       alog("[FromView] G3_MODIFY---------------start");
	if( $("#G3-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#G3-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#G3-CTLCUD").val("U");
       alog("[FromView] G3_MODIFY---------------end");
}
//새로고침	
function G3_RELOAD(token){
	alog("G3_RELOAD-----------------start");
	G3_SEARCH(lastinputG3,token);
}//사용자정의함수 : 사용자정의
function G3_USERDEF(token){
	alog("G3_USERDEF-----------------start");

	alog("G3_USERDEF-----------------end");
}
//FORMVIEW DELETE
function G3_DELETE(){	
	alog("G3_DELETE---------------start");

	//조회했는지 확인하기
	if( $("#G3-CTLCUD").val() != "R" ){
		alert("조회된 것만 삭제 가능합니다.");
		return;
	}
	//확인
	if(!confirm("정말로 삭제하시겠습니까?")){
		return;
	}
	
	//삭제처리 명령어
	$("#G3-CTLCUD").val("D");

	//폼객체를 불러와서
	var form1 = $("#formviewG3")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_G3_DELETE,
		data : formData,
		processData: false,
		contentType: false,
		success: function(tdata){
			alog(tdata);
			data = jQuery.parseJSON(tdata);
			//alert(data);
			if(data && data.RTN_CD == "200"){
				if(typeof(data.GRP_DATA) == "undefined" || data.GRP_DATA[0] == null || typeof(data.GRP_DATA[0].RTN_DATA) == "undefined"){
					msgNotice("오류를 발생하지 않았으나, 처리 내역이 없습니다.(GRP_DATA is null, SQL미등록)",1);
				}else{
					affectedRows = data.GRP_DATA[0].RTN_DATA;
					msgNotice("정상적으로 삭제되었습니다. [영향받은건수:" + affectedRows + "]",1);
				}
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
			}
		},
		error: function(error){
			alog("Error:");
			alog(error);
		}
	});
}
function G3_SEARCH(data,token){
	alog("(FORMVIEW) G3_SEARCH---------------start");

	//첫호출 이면 오브젝트에 이벤트 붙이기
	if(!isBindEvent_G3){

		//seq
		$( "#G3-ICONSEQ" ).keyup(function() {
			alog("G3-ICONSEQ change event.");
			rid = lastinputG3.get("__ROWID");
			cidx = mygridG2.getColIndexById("ICONSEQ");
			mygridG2.cells(rid,cidx).setValue($(this).val()); //값변경

			//부모 row 상태변경
			mygridG2.cells(rid,cidx).cell.wasChanged = true;
			RowEditStatus = mygridG2.getUserData(rid,"!nativeeditor_status");
			if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
				mygridG2.setUserData(rid,"!nativeeditor_status","updated");
				mygridG2.setRowTextBold(rid);	
			}
		});
		//IMGNM
		$( "#G3-IMGNM" ).keyup(function() {
			alog("G3-IMGNM change event.");
			rid = lastinputG3.get("__ROWID");
			cidx = mygridG2.getColIndexById("IMGNM");
			mygridG2.cells(rid,cidx).setValue($(this).val()); //값변경

			//부모 row 상태변경
			mygridG2.cells(rid,cidx).cell.wasChanged = true;
			RowEditStatus = mygridG2.getUserData(rid,"!nativeeditor_status");
			if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
				mygridG2.setUserData(rid,"!nativeeditor_status","updated");
				mygridG2.setRowTextBold(rid);	
			}
		});
		//IMGSIZE
		$( "#G3-IMGSIZE" ).keyup(function() {
			alog("G3-IMGSIZE change event.");
			rid = lastinputG3.get("__ROWID");
			cidx = mygridG2.getColIndexById("IMGSIZE");
			mygridG2.cells(rid,cidx).setValue($(this).val()); //값변경

			//부모 row 상태변경
			mygridG2.cells(rid,cidx).cell.wasChanged = true;
			RowEditStatus = mygridG2.getUserData(rid,"!nativeeditor_status");
			if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
				mygridG2.setUserData(rid,"!nativeeditor_status","updated");
				mygridG2.setRowTextBold(rid);	
			}
		});
		//IMGSVRNM
		$( "#G3-IMGSVRNM" ).keyup(function() {
			alog("G3-IMGSVRNM change event.");
			rid = lastinputG3.get("__ROWID");
			cidx = mygridG2.getColIndexById("IMGSVRNM");
			mygridG2.cells(rid,cidx).setValue($(this).val()); //값변경

			//부모 row 상태변경
			mygridG2.cells(rid,cidx).cell.wasChanged = true;
			RowEditStatus = mygridG2.getUserData(rid,"!nativeeditor_status");
			if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
				mygridG2.setUserData(rid,"!nativeeditor_status","updated");
				mygridG2.setRowTextBold(rid);	
			}
		});
		//IMGHASH
		$( "#G3-IMGHASH" ).keyup(function() {
			alog("G3-IMGHASH change event.");
			rid = lastinputG3.get("__ROWID");
			cidx = mygridG2.getColIndexById("IMGHASH");
			mygridG2.cells(rid,cidx).setValue($(this).val()); //값변경

			//부모 row 상태변경
			mygridG2.cells(rid,cidx).cell.wasChanged = true;
			RowEditStatus = mygridG2.getUserData(rid,"!nativeeditor_status");
			if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
				mygridG2.setUserData(rid,"!nativeeditor_status","updated");
				mygridG2.setRowTextBold(rid);	
			}
		});
		//IMGTYPE
		$( "#G3-IMGTYPE" ).change(function() {
			alog("G3-IMGTYPE change event.");
			rid = lastinputG3.get("__ROWID");
			cidx = mygridG2.getColIndexById("IMGTYPE");
			mygridG2.cells(rid,cidx).setValue($(this).val()); //값변경

			//부모 row 상태변경
			mygridG2.cells(rid,cidx).cell.wasChanged = true;
			RowEditStatus = mygridG2.getUserData(rid,"!nativeeditor_status");
			if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
				mygridG2.setUserData(rid,"!nativeeditor_status","updated");
				mygridG2.setRowTextBold(rid);	
			}
		});
		//CODEMIRROR
		obj_G3_CODEMIRROR.on("change", function(cmSql, change) {
			alog("G3_CODEMIRROR change -------------------------------start");
			alog("    cmSql.getValue :  (" + cmSql.getValue() + ")");
			alog("    change.origin : (" + change.origin + ")");
			alog("    change.from : (" + change.to + ")");
			alog("    change.text : (" + change.text + ")");
			alog("    change.removed : (" + change.removed + ")");
			alog("    change.to : (" + change.to + ")");

			//바인드 정보로 리턴하기
			if(change.origin != "setValue"){
				alog("G3-CODEMIRROR change event.");
				rid = lastinputG3.get("__ROWID");
				cidx = mygridG2.getColIndexById("CODEMIRROR");
				mygridG2.cells(rid,cidx).setValue(obj_G3_CODEMIRROR.getValue()); //값변경

				//부모 row 상태변경
				mygridG2.cells(rid,cidx).cell.wasChanged = true;
				RowEditStatus = mygridG2.getUserData(rid,"!nativeeditor_status");
				if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
					mygridG2.setUserData(rid,"!nativeeditor_status","updated");
					mygridG2.setRowTextBold(rid);	
				}
			}

		});
		//생성일
		$( "#G3-ADDDT" ).keyup(function() {
			alog("G3-ADDDT change event.");
			rid = lastinputG3.get("__ROWID");
			cidx = mygridG2.getColIndexById("ADDDT");
			mygridG2.cells(rid,cidx).setValue($(this).val()); //값변경

			//부모 row 상태변경
			mygridG2.cells(rid,cidx).cell.wasChanged = true;
			RowEditStatus = mygridG2.getUserData(rid,"!nativeeditor_status");
			if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
				mygridG2.setUserData(rid,"!nativeeditor_status","updated");
				mygridG2.setRowTextBold(rid);	
			}
		});

		isBindEvent_G3 = true;
	}
	$("#G3-ICONSEQ").val(data.get("G2-ICONSEQ"));//seq 변수세팅
	$("#G3-IMGNM").val(data.get("G2-IMGNM"));//IMGNM 변수세팅
	$("#G3-IMGSIZE").val(data.get("G2-IMGSIZE"));//IMGSIZE 변수세팅
	$("#G3-IMGSVRNM").val(data.get("G2-IMGSVRNM"));//IMGSVRNM 변수세팅
	$("#G3-IMGHASH").val(data.get("G2-IMGHASH"));//IMGHASH 변수세팅
	$("#G3-IMGTYPE").val(data.get("G2-IMGTYPE"));//IMGTYPE 변수세팅
		obj_G3_CODEMIRROR.setValue(data.get("G2-CODEMIRROR")); //CODEMIRROR 
	$("#G3-ADDDT").val(data.get("G2-ADDDT"));//생성일 변수세팅
	alog("(FORMVIEW) G3_SEARCH---------------end");

}
//	
function G3_NEW(){
       alog("[FromView] G3_NEW---------------start");
	$("#G3-CTLCUD").val("C");
	//PMGIO 로직
	$("#G3-ICONSEQ").val("");//seq 신규초기화	
	$("#G3-IMGNM").val("");//IMGNM 신규초기화	
	$("#G3-IMGSIZE").val("");//IMGSIZE 신규초기화	
	$("#G3-IMGSVRNM").val("");//IMGSVRNM 신규초기화	
	$("#G3-IMGHASH").val("");//IMGHASH 신규초기화	
	obj_G3_CODEMIRROR.setValue(""); // CODEMIRROR값 비우기
				$("#G3-ICONFILE-LINK").attr("href","");//ICONFILE NEW
				$("#G3-ICONFILE-NM").text("");//ICONFILE NEW
	$("#G3-ADDDT").val("");//생성일 신규초기화	
       alog("DETAILNew30---------------end");
}
