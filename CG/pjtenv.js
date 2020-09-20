var grpInfo = new HashMap();
		//
grpInfo.set(
	"G2", 
		{
			"GRPTYPE": "CONDITION"
			,"GRPNM": "2"
			,"KEYCOLID": ""
			,"SEQYN": "N"
			,"COLS": [
				{ "COLID": "PJTID", "COLNM" : "프로젝트ID", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "ADDDT", "COLNM" : "생성일", "OBJTYPE" : "CALENDAR" }
,				{ "COLID": "MYRADIO", "COLNM" : "나의라디오", "OBJTYPE" : "INPUTRADIO" }
			]
		}
); //2
grpInfo.set(
	"G6", 
		{
			"GRPTYPE": "GRID"
			,"GRPNM": "CONFIG"
			,"KEYCOLID": ""
			,"SEQYN": "N"
			,"COLS": [
				{ "COLID": "CFGSEQ", "COLNM" : "SEQ", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "USEYN", "COLNM" : "사용", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "CFGID", "COLNM" : "CFGID", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "CFGNM", "COLNM" : "CFGNM", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "MVCGBN", "COLNM" : "MVCGBN", "OBJTYPE" : "COMBORO" }
,				{ "COLID": "PATH", "COLNM" : "PATH", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "CFGORD", "COLNM" : "ORD", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "ADDDT", "COLNM" : "ADDDT", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "MODDT", "COLNM" : "MODDT", "OBJTYPE" : "INPUTBOX" }
			]
		}
); //CONFIG
grpInfo.set(
	"G7", 
		{
			"GRPTYPE": "GRID"
			,"GRPNM": "FILE"
			,"KEYCOLID": ""
			,"SEQYN": "N"
			,"COLS": [
				{ "COLID": "FILESEQ", "COLNM" : "SEQ", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "MKFILETYPE", "COLNM" : "파일타입", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "MKFILETYPENM", "COLNM" : "타입명", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "MKFILEFORMAT", "COLNM" : "포멧", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "MKFILEEXT", "COLNM" : "확장자", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "TEMPLATE", "COLNM" : "템플릿", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "FILEORD", "COLNM" : "순번", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "USEYN", "COLNM" : "사용", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "ADDDT", "COLNM" : "ADDDT", "OBJTYPE" : "INPUTBOX" }
,				{ "COLID": "MODDT", "COLNM" : "MODDT", "OBJTYPE" : "INPUTBOX" }
			]
		}
); //FILE
//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G2_SEARCHALL = "pjtenvController?CTLGRP=G2&CTLFNC=SEARCHALL";
//2 변수 선언	
var obj_G2_PJTID; // 프로젝트ID 변수선언
var obj_G2_ADDDT; // 생성일 변수선언
var obj_G2_MYRADIO; // 나의라디오 변수선언
//그리드 변수 초기화	
//컨트롤러 경로
var url_G6_USERDEF = "pjtenvController?CTLGRP=G6&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G6_SEARCH = "pjtenvController?CTLGRP=G6&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G6_SAVE = "pjtenvController?CTLGRP=G6&CTLFNC=SAVE";
//컨트롤러 경로
var url_G6_ROWDELETE = "pjtenvController?CTLGRP=G6&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G6_ROWADD = "pjtenvController?CTLGRP=G6&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G6_RELOAD = "pjtenvController?CTLGRP=G6&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G6_EXCEL = "pjtenvController?CTLGRP=G6&CTLFNC=EXCEL";
//그리드 객체
var mygridG6,isToggleHiddenColG6,lastinputG6,lastinputG6json,lastrowidG6;
var lastselectG6json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G7_USERDEF = "pjtenvController?CTLGRP=G7&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G7_SEARCH = "pjtenvController?CTLGRP=G7&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G7_SAVE = "pjtenvController?CTLGRP=G7&CTLFNC=SAVE";
//컨트롤러 경로
var url_G7_ROWDELETE = "pjtenvController?CTLGRP=G7&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G7_ROWADD = "pjtenvController?CTLGRP=G7&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G7_RELOAD = "pjtenvController?CTLGRP=G7&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G7_EXCEL = "pjtenvController?CTLGRP=G7&CTLFNC=EXCEL";
//그리드 객체
var mygridG7,isToggleHiddenColG7,lastinputG7,lastinputG7json,lastrowidG7;
var lastselectG7json;//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");

	//dhtmlx 메시지 박스 초기화
	//dhtmlx.message.position="bottom";

	//메시지 박스2
	toastr.options.closeButton = true;
	toastr.options.positionClass = 'toast-bottom-right';
	G2_INIT();	
	G6_INIT();	
	G7_INIT();	
      feather.replace();
	alog("initBody()-----------------------end");
} //initBody()	
//팝업띄우기		
	//팝업창 오픈요청
function goGridPopOpen(tGrpId,tRowId,tColIndex,tValue,tText){
	alog("goGridPopOpen()............. tGrpId = " + tGrpId + ", tRowId = " + tRowId + ", tColIndex = " + tColIndex + ", tValue = " + tValue + ", tText = " + tText);
	
	//PGMGRP ,  	
	tColId = mygridG2.getColumnId(tColIndex);
	tColId = mygridG2.getColumnId(tColIndex);
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
function G2_INIT(){
  alog("G2_INIT()-------------------------start	");
	//각 폼 오브젝트들 초기화
	//PJTID, 프로젝트ID 초기화	
	$("#G2-PJTID").attr("readonly",true);
	$("#G2-PJTID").attr("disabled",true);
	//달력 ADDDT, 생성일
	$( "#G2-ADDDT" ).datepicker(dateFormatJson);
	//G2-생성일
	var cleave = new Cleave('.formatDate', {
        date: true,
        delimiter: '-',
        datePattern: ['Y', 'm', 'd']
    });
	//MYRADIO, 나의라디오 초기화	
setCodeRadio("CONDITION", "G2-MYRADIO", "CRUD");

	$("input:radio[id='G2-MYRADIO']").attr('disabled', true); //나의라디오
  alog("G2_INIT()-------------------------end");
}

	//CONFIG 그리드 초기화
function G6_INIT(){
  alog("G6_INIT()-------------------------start");

	//그리드 초기화
	mygridG6 = new dhtmlXGridObject('gridG6');
	mygridG6.setImagePath(CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
	mygridG6.setUserData("","gridTitle","G6 : CONFIG"); //글로별 변수에 그리드 타이블 넣기
	//헤더초기화
	mygridG6.setHeader("SEQ,사용,CFGID,CFGNM,MVCGBN,PATH,ORD,ADDDT,MODDT");
	//헤더 필터추가
	mygridG6.attachHeader(",#text_filter,#text_filter,#text_filter,#select_filter,#text_filter,#numeric_filter,,");
	mygridG6.setColumnIds("CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT");
	mygridG6.setInitWidths("50,50,60,120,60,300,30,80,80");
	mygridG6.setColTypes("ed,ed,ed,ed,coro,ed,ed,ed,ed");
	//가로 정렬	
	mygridG6.setColAlign("left,left,left,left,left,left,left,left,left");
	mygridG6.setColSorting("int,str,str,str,str,str,int,str,str");	//렌더링	
	mygridG6.enableSmartRendering(true);
	mygridG6.enableMultiselect(true);
	//mygridG6.setColValidators("G6_CFGSEQ,G6_USEYN,G6_CFGID,G6_CFGNM,G6_MVCGBN,G6_PATH,G6_CFGORD,G6_ADDDT,G6_MODDT");
	mygridG6.splitAt(0);//'freezes' 0 columns 
	mygridG6.init();
	mygridG6.setDateFormat("%Y-%m-%d");

	mygridG6.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG6.enableBlockSelection(true);
		mygridG6.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG6.editor){
				mygridG6.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG6.copyBlockToClipboard();

					var top_row_idx = mygridG6.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG6.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG6.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG6.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG6.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG6.getRowId(j);
						RowEditStatus = mygridG6.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG6.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG6.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : SEQ초기화	
		 // IO : 사용초기화	
		 // IO : CFGID초기화	
		 // IO : CFGNM초기화	
		apiCodeCombo('G6','MVCGBN',{'G1-PCD':'MVCGBN'},''); // IO : MVCGBN초기화	
		 // IO : PATH초기화	
		 // IO : ORD초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
	//onCheck
		mygridG6.attachEvent("onCheck",function(rowId, cellInd, state){
			alog("mygridG6  onCheck ------------------start");
			alog("	rowId=" + rowId + ", cellInd=" + cellInd + ", state=" + state);

			RowEditStatus = mygridG6.getUserData(rowId,"!nativeeditor_status");
			alog("	RowEditStatus=" + RowEditStatus);
			//[일반 체크] 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				if(RowEditStatus == ""){
					mygridG6.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG6.setRowTextBold(rowId);
					mygridG6.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
	//onEditCell 이벤트
	mygridG6.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
		alog("mygridG6  onEditCell ------------------start");
		alog("	stage : " + stage + ", rId : " + rId + ", cInd : " + cInd + ", nValue : " + nValue + ", oValue : " + oValue);

		RowEditStatus = mygridG6.getUserData(rId,"!nativeeditor_status");
		alog("	RowEditStatus = " + RowEditStatus);

		//체크박스 아닌 일반 컬럼
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG6.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG6.setRowTextBold(rId);
                }
                mygridG6.cells(rId,cInd).cell.wasChanged = true;
            }

            return true;
	});
	alog("G6_INIT()-------------------------end");
}
	//FILE 그리드 초기화
function G7_INIT(){
  alog("G7_INIT()-------------------------start");

	//그리드 초기화
	mygridG7 = new dhtmlXGridObject('gridG7');
	mygridG7.setImagePath(CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
	mygridG7.setUserData("","gridTitle","G7 : FILE"); //글로별 변수에 그리드 타이블 넣기
	//헤더초기화
	mygridG7.setHeader("SEQ,파일타입,타입명,포멧,확장자,템플릿,순번,사용,ADDDT,MODDT");
	mygridG7.setColumnIds("FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT");
	mygridG7.setInitWidths("50,50,50,50,50,50,50,50,50,50");
	mygridG7.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
	//가로 정렬	
	mygridG7.setColAlign("left,left,left,left,left,left,left,left,left,left");
	mygridG7.setColSorting("str,str,str,str,str,str,str,str,str,str");	//렌더링	
	mygridG7.enableSmartRendering(true);
	mygridG7.enableMultiselect(true);
	//mygridG7.setColValidators("G7_FILESEQ,G7_MKFILETYPE,G7_MKFILETYPENM,G7_MKFILEFORMAT,G7_MKFILEEXT,G7_TEMPLATE,G7_FILEORD,G7_USEYN,G7_ADDDT,G7_MODDT");
	mygridG7.splitAt(0);//'freezes' 0 columns 
	mygridG7.init();
	mygridG7.setDateFormat("%Y-%m-%d");

	mygridG7.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG7.enableBlockSelection(true);
		mygridG7.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG7.editor){
				mygridG7.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG7.copyBlockToClipboard();

					var top_row_idx = mygridG7.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG7.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG7.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG7.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG7.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG7.getRowId(j);
						RowEditStatus = mygridG7.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG7.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG7.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : SEQ초기화	
		 // IO : 파일타입초기화	
		 // IO : 타입명초기화	
		 // IO : 포멧초기화	
		 // IO : 확장자초기화	
		 // IO : 템플릿초기화	
		 // IO : 순번초기화	
		 // IO : 사용초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
	//onCheck
		mygridG7.attachEvent("onCheck",function(rowId, cellInd, state){
			alog("mygridG7  onCheck ------------------start");
			alog("	rowId=" + rowId + ", cellInd=" + cellInd + ", state=" + state);

			RowEditStatus = mygridG7.getUserData(rowId,"!nativeeditor_status");
			alog("	RowEditStatus=" + RowEditStatus);
			//[일반 체크] 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				if(RowEditStatus == ""){
					mygridG7.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG7.setRowTextBold(rowId);
					mygridG7.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
	//onEditCell 이벤트
	mygridG7.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
		alog("mygridG7  onEditCell ------------------start");
		alog("	stage : " + stage + ", rId : " + rId + ", cInd : " + cInd + ", nValue : " + nValue + ", oValue : " + oValue);

		RowEditStatus = mygridG7.getUserData(rId,"!nativeeditor_status");
		alog("	RowEditStatus = " + RowEditStatus);

		//체크박스 아닌 일반 컬럼
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG7.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG7.setRowTextBold(rId);
                }
                mygridG7.cells(rId,cInd).cell.wasChanged = true;
            }

            return true;
	});
	alog("G7_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
// CONDITIONSearch	
function G2_SEARCHALL(token){
	alog("G2_SEARCHALL--------------------------start");
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G2
			lastinputG6 = new HashMap(); //CONFIG
				lastinputG7 = new HashMap(); //FILE
		//  호출
	G6_SEARCH(lastinputG6,token);
	//  호출
	G7_SEARCH(lastinputG7,token);
	alog("G2_SEARCHALL--------------------------end");
}
    function G6_ROWDELETE(){	
        alog("G6_ROWDELETE()------------start");
        delRow(mygridG6);
        alog("G6_ROWDELETE()------------start");
    }
	//CONFIG
function G6_SAVE(token){
	alog("G6_SAVE()------------start");
	tgrid = mygridG6;

	tgrid.setSerializationLevel(true,false,false,false,true,true);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		var conAllData = "";
	//상속받은거 전달할수 있게 합치기
	if(typeof lastinputG6 != "undefined" && lastinputG6 != null){
		var tKeys = lastinputG6.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],lastinputG6.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ lastinputG6.get(tKeys[i])); 
		}
	}
	sendFormData.append("G6-XML" , myXmlString);
	//그리드G6 가져오기	
    mygridG6.setSerializationLevel(true,false,false,false,true,false);
    var paramsG6 = mygridG6.serialize();
	sendFormData.append("G6-XML",paramsG6);

	$.ajax({
		type : "POST",
		url : url_G6_SAVE+"&TOKEN=" + token + "&" + conAllData ,
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
	
	alog("G6_SAVE()------------end");
}








//그리드 조회(CONFIG)	
function G6_SEARCH(tinput,token){
	alog("G6_SEARCH()------------start");

	var tGrid = mygridG6;

	//그리드 초기화
	tGrid.clearAll();
	//post 만들기
	sendFormData = new FormData($("#condition")[0]);
	var conAllData = "";
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}
	sendFormData.append("G2-MYRADIO",$('input[name="G2-MYRADIO"]:checked').val());//radio 선택값 가져오기.

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G6_SEARCH+"&TOKEN=" + token + "&" + conAllData ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG6Cnt").text(row_cnt);
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG6Cnt").text("-");
					}
					msgNotice("[CONFIG] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[CONFIG] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[CONFIG] Ajax http 500 error ( " + error + " )",3);
                alog("[CONFIG] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G6_SEARCH()------------end");
    }

//엑셀다운		
function G6_EXCEL(){	
	alog("G6_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/common/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG6.setSerializationLevel(true,false,false,false,false,true);
	var myXmlString = mygridG6.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("50,50,60,120,60,300,30,80,80");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//사용자정의함수 : 사용자정의
function G6_USERDEF(token){
	alog("G6_USERDEF-----------------start");

	alog("G6_USERDEF-----------------end");
}
//새로고침	
function G6_RELOAD(token){
  alog("G6_RELOAD-----------------start");
  G6_SEARCH(lastinputG6,token);
}
//행추가3 (CONFIG)	
//그리드 행추가 : CONFIG
	function G6_ROWADD(){
		if( !(lastinputG6)|| lastinputG6.get("G6-PJTSEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","",""];//초기값
			addRow(mygridG6,tCols);
		}
	}//엑셀다운		
function G7_EXCEL(){	
	alog("G7_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/common/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG7.setSerializationLevel(true,false,false,false,false,true);
	var myXmlString = mygridG7.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("50,50,50,50,50,50,50,50,50,50");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G7_RELOAD(token){
  alog("G7_RELOAD-----------------start");
  G7_SEARCH(lastinputG7,token);
}








//그리드 조회(FILE)	
function G7_SEARCH(tinput,token){
	alog("G7_SEARCH()------------start");

	var tGrid = mygridG7;

	//그리드 초기화
	tGrid.clearAll();
	//post 만들기
	sendFormData = new FormData($("#condition")[0]);
	var conAllData = "";
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}
	sendFormData.append("G2-MYRADIO",$('input[name="G2-MYRADIO"]:checked').val());//radio 선택값 가져오기.

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G7_SEARCH+"&TOKEN=" + token + "&" + conAllData ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG7 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG7Cnt").text(row_cnt);
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG7Cnt").text("-");
					}
					msgNotice("[FILE] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[FILE] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[FILE] Ajax http 500 error ( " + error + " )",3);
                alog("[FILE] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G7_SEARCH()------------end");
    }

//행추가3 (FILE)	
//그리드 행추가 : FILE
	function G7_ROWADD(){
		if( !(lastinputG7)|| lastinputG7.get("G7-PJTSEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","","",""];//초기값
			addRow(mygridG7,tCols);
		}
	}//사용자정의함수 : 사용자정의
function G7_USERDEF(token){
	alog("G7_USERDEF-----------------start");

	alog("G7_USERDEF-----------------end");
}
    function G7_ROWDELETE(){	
        alog("G7_ROWDELETE()------------start");
        delRow(mygridG7);
        alog("G7_ROWDELETE()------------start");
    }
	//FILE
function G7_SAVE(token){
	alog("G7_SAVE()------------start");
	tgrid = mygridG7;

	tgrid.setSerializationLevel(true,false,false,false,true,true);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		var conAllData = "";
	//상속받은거 전달할수 있게 합치기
	if(typeof lastinputG7 != "undefined" && lastinputG7 != null){
		var tKeys = lastinputG7.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],lastinputG7.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ lastinputG7.get(tKeys[i])); 
		}
	}
	sendFormData.append("G7-XML" , myXmlString);
	//그리드G7 가져오기	
    mygridG7.setSerializationLevel(true,false,false,false,true,false);
    var paramsG7 = mygridG7.serialize();
	sendFormData.append("G7-XML",paramsG7);

	$.ajax({
		type : "POST",
		url : url_G7_SAVE+"&TOKEN=" + token + "&" + conAllData ,
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
	
	alog("G7_SAVE()------------end");
}
