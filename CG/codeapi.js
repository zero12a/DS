var grpInfo = new HashMap();
grpInfo.set(
	"G1", 
		{
			"GRPTYPE": "CONDITION"
			,"GRPNM": ""
			,"KEYCOLID": ""
			,"SEQYN": "N"
		}
); //
grpInfo.set(
	"G2", 
		{
			"GRPTYPE": "GRID"
			,"GRPNM": "조회결과"
			,"KEYCOLID": ""
			,"SEQYN": "N"
		}
); //조회결과
grpInfo.set(
	"G3", 
		{
			"GRPTYPE": "FORMVIEW"
			,"GRPNM": "CDD"
			,"KEYCOLID": ""
			,"SEQYN": "N"
		}
); //CDD
//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_CDD = "codeapiController?CTLGRP=G1&CTLFNC=CDD";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_GETSVCSQLLIST = "codeapiController?CTLGRP=G1&CTLFNC=GETSVCSQLLIST";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_PGMSEQ_POPUP = "codeapiController?CTLGRP=G1&CTLFNC=PGMSEQ_POPUP";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_PSQLSEQ = "codeapiController?CTLGRP=G1&CTLFNC=PSQLSEQ";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SVCGRP = "codeapiController?CTLGRP=G1&CTLFNC=SVCGRP";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SVRSEQ = "codeapiController?CTLGRP=G1&CTLFNC=SVRSEQ";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_VALIDSEQ = "codeapiController?CTLGRP=G1&CTLFNC=VALIDSEQ";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_sCodeD = "codeapiController?CTLGRP=G1&CTLFNC=sCodeD";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "codeapiController?CTLGRP=G1&CTLFNC=RESET";
// 변수 선언	
var obj_G1_PCD; // PCD 변수선언
var obj_G1_CD; // CD 변수선언
var obj_G1_PJTSEQ; // PJTSEQ 변수선언
var obj_G1_PGMSEQ; // PGMSEQ 변수선언
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_CDD = "codeapiController?CTLGRP=G2&CTLFNC=CDD";
//컨트롤러 경로
var url_G2_GETSVCSQLLIST = "codeapiController?CTLGRP=G2&CTLFNC=GETSVCSQLLIST";
//컨트롤러 경로
var url_G2_PGMSEQ_POPUP = "codeapiController?CTLGRP=G2&CTLFNC=PGMSEQ_POPUP";
//컨트롤러 경로
var url_G2_PSQLSEQ = "codeapiController?CTLGRP=G2&CTLFNC=PSQLSEQ";
//컨트롤러 경로
var url_G2_SVCGRP = "codeapiController?CTLGRP=G2&CTLFNC=SVCGRP";
//컨트롤러 경로
var url_G2_SVRSEQ = "codeapiController?CTLGRP=G2&CTLFNC=SVRSEQ";
//컨트롤러 경로
var url_G2_VALIDSEQ = "codeapiController?CTLGRP=G2&CTLFNC=VALIDSEQ";
//컨트롤러 경로
var url_G2_SEARCH = "codeapiController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_RELOAD = "codeapiController?CTLGRP=G2&CTLFNC=RELOAD";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//디테일 변수 초기화	

var isBindEvent_G3 = false; //바인드폼 구성시 이벤트 부여여부
//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "codeapiController?CTLGRP=G3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G3_RELOAD = "codeapiController?CTLGRP=G3&CTLFNC=RELOAD";
var obj_G3_CODED_SEQ;   // SEQ 글로벌 변수 선언
var obj_G3_CD;   // CD 글로벌 변수 선언
var obj_G3_NM;   // NM 글로벌 변수 선언
var obj_G3_CDDESC;   // CDDESC 글로벌 변수 선언
var obj_G3_PCD;   // PCD 글로벌 변수 선언
var obj_G3_ORD;   // ORD 글로벌 변수 선언
var obj_G3_CDVAL;   // CDVAL 글로벌 변수 선언
var obj_G3_CDVAL2;   // CDVAL2 글로벌 변수 선언
var obj_G3_CDMIN;   // CDMIN 글로벌 변수 선언
var obj_G3_CDMAX;   // CDMAX 글로벌 변수 선언
var obj_G3_DATATYPE;   // 데이터타입 글로벌 변수 선언
var obj_G3_EDITYN;   // EDITYN 글로벌 변수 선언
var obj_G3_FORMATYN;   // FORMATYN 글로벌 변수 선언
var obj_G3_USEYN;   // 사용 글로벌 변수 선언
var obj_G3_DELYN;   // 삭제YN 글로벌 변수 선언
var obj_G3_ADDDT;   // 생성일 글로벌 변수 선언
var obj_G3_MODDT;   // MODDT 글로벌 변수 선언
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
	//PCD, PCD 초기화	
	$("#G1-PCD").attr( "placeholder", "CDD, sCodeD" );
	//CD, CD 초기화	
	$("#G1-CD").attr( "placeholder", "CDD" );
	//PJTSEQ, PJTSEQ 초기화	
	$("#G1-PJTSEQ").attr( "placeholder", "GETSVCSQLLIST, VALIDSEQ, SVCGRP, SVCGRP, PSQLSEQ" );
	//PGMSEQ, PGMSEQ 초기화	
	$("#G1-PGMSEQ").attr( "placeholder", "GETSVCSQLLIST, SVCGRP, PSQLSEQ" );
  alog("G1_INIT()-------------------------end");
}

	//조회결과 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

	//그리드 초기화
	mygridG2 = new dhtmlXGridObject('gridG2');
	mygridG2.setImagePath(CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
	mygridG2.setUserData("","gridTitle","G2 : 조회결과"); //글로별 변수에 그리드 타이블 넣기
	//헤더초기화
	mygridG2.setHeader("CD,NM");
	mygridG2.setColumnIds("CD,NM");
	mygridG2.setInitWidthsP("40,60");
	mygridG2.setColTypes("ed,ed");
	//가로 정렬	
	mygridG2.setColAlign("left,left");
	mygridG2.setColSorting("str,str");	//렌더링	
	mygridG2.enableSmartRendering(true);
	mygridG2.enableMultiselect(true);
	//mygridG2.setColValidators("G2_CD,G2_NM");
	mygridG2.splitAt(0);//'freezes' 0 columns 
	mygridG2.init();
	mygridG2.setDateFormat("%Y-%m-%d");

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
		 // IO : CD초기화	
		 // IO : NM초기화	
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
//CDD 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");
	//컬럼 초기화
	//CODED_SEQ, SEQ 초기화	
	//CD, CD 초기화	
	//NM, NM 초기화	
	//CDDESC, CDDESC 초기화	
	//PCD, PCD 초기화	
	//ORD, ORD 초기화	
	//CDVAL, CDVAL 초기화	
	//CDVAL2, CDVAL2 초기화	
	//CDMIN, CDMIN 초기화	
	//CDMAX, CDMAX 초기화	
	//DATATYPE, 데이터타입 초기화	
	//EDITYN, EDITYN 초기화	
	//FORMATYN, FORMATYN 초기화	
	//USEYN, 사용 초기화	
	//DELYN, 삭제YN 초기화	
	//ADDDT, 생성일 초기화
	//MODDT, MODDT 초기화
  alog("G3_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//사용자정의함수 : VALIDSEQ
function G1_VALIDSEQ(token){
	alog("G1_VALIDSEQ-----------------start");
G2_VALIDSEQ(null, uuidv4());

	alog("G1_VALIDSEQ-----------------end");
}
//사용자정의함수 : SVRSEQ
function G1_SVRSEQ(token){
	alog("G1_SVRSEQ-----------------start");
G2_SVRSEQ(null, uuidv4());

	alog("G1_SVRSEQ-----------------end");
}
//사용자정의함수 : PSQLSEQ
function G1_PSQLSEQ(token){
	alog("G1_PSQLSEQ-----------------start");
G2_PSQLSEQ(null, uuidv4());

	alog("G1_PSQLSEQ-----------------end");
}
//사용자정의함수 : SVCGRP
function G1_SVCGRP(token){
	alog("G1_SVCGRP-----------------start");
G2_SVCGRP(null, uuidv4());

	alog("G1_SVCGRP-----------------end");
}
//사용자정의함수 : PGMSEQ_POPUP
function G1_PGMSEQ_POPUP(token){
	alog("G1_PGMSEQ_POPUP-----------------start");
G2_PGMSEQ_POPUP(null, uuidv4());

	alog("G1_PGMSEQ_POPUP-----------------end");
}
//사용자정의함수 : GETSVCSQLLIST
function G1_GETSVCSQLLIST(token){
	alog("G1_GETSVCSQLLIST-----------------start");
G2_GETSVCSQLLIST(null,uuidv4());

	alog("G1_GETSVCSQLLIST-----------------end");
}
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//사용자정의함수 : CDD
function G1_CDD(token){
	alog("G1_CDD-----------------start");
G3_SEARCH(null,uuidv4());

	alog("G1_CDD-----------------end");
}
// CONDITIONSearch	
function G1_sCodeD(token){
	alog("G1_sCodeD--------------------------start");
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //조회결과
				lastinputG2 = new HashMap(); //조회결과
				lastinputG2 = new HashMap(); //조회결과
				lastinputG2 = new HashMap(); //조회결과
				lastinputG2 = new HashMap(); //조회결과
				lastinputG2 = new HashMap(); //조회결과
				lastinputG2 = new HashMap(); //조회결과
				lastinputG2 = new HashMap(); //조회결과
				lastinputG3 = new HashMap(); //CDD
		//  호출
	G2_SEARCH(lastinputG2,token);
	//  호출
	G3_SEARCH(lastinputG3,token);
	alog("G1_SEARCHALL--------------------------end");
}








//그리드 조회(조회결과)	
function G2_PSQLSEQ(tinput,token){
	alog("G2_PSQLSEQ()------------start");

	var tGrid = mygridG2;

	//그리드 초기화
	tGrid.clearAll();
	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_PSQLSEQ+"&TOKEN=" + token + "&" + conAllData ,
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
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[조회결과] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[조회결과] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[조회결과] Ajax http 500 error ( " + error + " )",3);
                alog("[조회결과] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_PSQLSEQ()------------end");
    }









//그리드 조회(조회결과)	
function G2_PGMSEQ_POPUP(tinput,token){
	alog("G2_PGMSEQ_POPUP()------------start");

	var tGrid = mygridG2;

	//그리드 초기화
	tGrid.clearAll();
	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_PGMSEQ_POPUP+"&TOKEN=" + token + "&" + conAllData ,
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
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[조회결과] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[조회결과] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[조회결과] Ajax http 500 error ( " + error + " )",3);
                alog("[조회결과] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_PGMSEQ_POPUP()------------end");
    }









//그리드 조회(조회결과)	
function G2_CDD(tinput,token){
	alog("G2_CDD()------------start");

	var tGrid = mygridG2;

	//그리드 초기화
	tGrid.clearAll();
	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_CDD+"&TOKEN=" + token + "&" + conAllData ,
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
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[조회결과] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[조회결과] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[조회결과] Ajax http 500 error ( " + error + " )",3);
                alog("[조회결과] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_CDD()------------end");
    }









//그리드 조회(조회결과)	
function G2_GETSVCSQLLIST(tinput,token){
	alog("G2_GETSVCSQLLIST()------------start");

	var tGrid = mygridG2;

	//그리드 초기화
	tGrid.clearAll();
	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_GETSVCSQLLIST+"&TOKEN=" + token + "&" + conAllData ,
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
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[조회결과] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[조회결과] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[조회결과] Ajax http 500 error ( " + error + " )",3);
                alog("[조회결과] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_GETSVCSQLLIST()------------end");
    }

//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}








//그리드 조회(조회결과)	
function G2_SEARCH(tinput,token){
	alog("G2_SEARCH()------------start");

	var tGrid = mygridG2;

	//그리드 초기화
	tGrid.clearAll();
	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SEARCH+"&TOKEN=" + token + "&" + conAllData ,
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
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[조회결과] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[조회결과] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[조회결과] Ajax http 500 error ( " + error + " )",3);
                alog("[조회결과] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }









//그리드 조회(조회결과)	
function G2_SVRSEQ(tinput,token){
	alog("G2_SVRSEQ()------------start");

	var tGrid = mygridG2;

	//그리드 초기화
	tGrid.clearAll();
	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SVRSEQ+"&TOKEN=" + token + "&" + conAllData ,
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
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[조회결과] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[조회결과] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[조회결과] Ajax http 500 error ( " + error + " )",3);
                alog("[조회결과] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SVRSEQ()------------end");
    }









//그리드 조회(조회결과)	
function G2_VALIDSEQ(tinput,token){
	alog("G2_VALIDSEQ()------------start");

	var tGrid = mygridG2;

	//그리드 초기화
	tGrid.clearAll();
	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_VALIDSEQ+"&TOKEN=" + token + "&" + conAllData ,
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
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[조회결과] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[조회결과] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[조회결과] Ajax http 500 error ( " + error + " )",3);
                alog("[조회결과] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_VALIDSEQ()------------end");
    }









//그리드 조회(조회결과)	
function G2_SVCGRP(tinput,token){
	alog("G2_SVCGRP()------------start");

	var tGrid = mygridG2;

	//그리드 초기화
	tGrid.clearAll();
	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
		//tinput 넣어주기
		if(typeof tinput != "undefined" && tinput != null){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SVCGRP+"&TOKEN=" + token + "&" + conAllData ,
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
						var beforeDate = new Date();
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						var afterDate = new Date();
						alog("	parse render time(ms) = " + (afterDate - beforeDate));
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[조회결과] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[조회결과] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[조회결과] Ajax http 500 error ( " + error + " )",3);
                alog("[조회결과] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SVCGRP()------------end");
    }

//디테일 검색	
function G3_SEARCH(tinput,token){
       alog("(FORMVIEW) G3_SEARCH---------------start");

	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
	if(typeof tinput != "undefined" && tinput != null){
		var tKeys = tinput.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
		}
	}

	$.ajax({
        type : "POST",
        url : url_G3_SEARCH+"&TOKEN=" + token + "&" + conAllData ,
        data : sendFormData,
		processData: false,
		contentType: false,
        dataType: "json",
        success: function(data){
            alog(data);

			if(data && data.RTN_CD == "200"){
				if(data.RTN_DATA){
					msgNotice("정상적으로 조회되었습니다.",1);
				}else{
					msgNotice("정상적으로 조회되었으나 데이터가 없습니다.",2);
					return;
				}
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
				return;
			}

            //모드 변경하기
            $("#G3-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
			$("#G3-CODED_SEQ").val(data.RTN_DATA.CODED_SEQ);//SEQ 변수세팅
			$("#G3-CD").val(data.RTN_DATA.CD);//CD 변수세팅
			$("#G3-NM").val(data.RTN_DATA.NM);//NM 변수세팅
			$("#G3-CDDESC").val(data.RTN_DATA.CDDESC);//CDDESC 변수세팅
			$("#G3-PCD").val(data.RTN_DATA.PCD);//PCD 변수세팅
			$("#G3-ORD").val(data.RTN_DATA.ORD);//ORD 변수세팅
			$("#G3-CDVAL").val(data.RTN_DATA.CDVAL);//CDVAL 변수세팅
			$("#G3-CDVAL2").val(data.RTN_DATA.CDVAL2);//CDVAL2 변수세팅
			$("#G3-CDMIN").val(data.RTN_DATA.CDMIN);//CDMIN 변수세팅
			$("#G3-CDMAX").val(data.RTN_DATA.CDMAX);//CDMAX 변수세팅
			$("#G3-DATATYPE").val(data.RTN_DATA.DATATYPE);//데이터타입 변수세팅
			$("#G3-EDITYN").val(data.RTN_DATA.EDITYN);//EDITYN 변수세팅
			$("#G3-FORMATYN").val(data.RTN_DATA.FORMATYN);//FORMATYN 변수세팅
			$("#G3-USEYN").val(data.RTN_DATA.USEYN);//사용 변수세팅
			$("#G3-DELYN").val(data.RTN_DATA.DELYN);//삭제YN 변수세팅
	$("#G3-ADDDT").text(data.RTN_DATA.ADDDT);//생성일 변수세팅
	$("#G3-MODDT").text(data.RTN_DATA.MODDT);//MODDT 변수세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) G3_SEARCH---------------end");

}
//새로고침	
function G3_RELOAD(token){
	alog("G3_RELOAD-----------------start");
	G3_SEARCH(lastinputG3,token);
}