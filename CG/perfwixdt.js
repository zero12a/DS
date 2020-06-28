var grpInfo = new HashMap();
grpInfo.set(
	"G1", 
		{
			"GRPTYPE": "CONDITION"
			,"GRPNM": ""
			,"KEYCOLID": ""
			,"SEQYN": ""
		}
); //
grpInfo.set(
	"G2", 
		{
			"GRPTYPE": "GRIDWIX"
			,"GRPNM": "rst3"
			,"KEYCOLID": ""
			,"SEQYN": ""
		}
); //rst3
//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "perfwixdtController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "perfwixdtController?CTLGRP=G1&CTLFNC=RESET";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVEA = "perfwixdtController?CTLGRP=G1&CTLFNC=SAVEA";
// 변수 선언	
var obj_G2_FILETYPE_POPUP = null;// FILETYPE 글로벌 변수 선언 - 팝업
//컨트롤러 경로
var url_G2_ELOAD = "perfwixdtController?CTLGRP=G2&CTLFNC=ELOAD";
//컨트롤러 경로
var url_G2_SEARCH = "perfwixdtController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_RELOAD = "perfwixdtController?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_SV = "perfwixdtController?CTLGRP=G2&CTLFNC=SV";
//컨트롤러 경로
var url_G2_UDEF = "perfwixdtController?CTLGRP=G2&CTLFNC=UDEF";
//컨트롤러 경로
var url_G2_DOWN = "perfwixdtController?CTLGRP=G2&CTLFNC=DOWN";
//컨트롤러 경로
var url_G2_HDNCOL = "perfwixdtController?CTLGRP=G2&CTLFNC=HDNCOL";
//그리드 객체
var wixdtG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
	G2_INIT();	
      feather.replace();
	alog("initBody()-----------------------end");
} //initBody()	
//팝업띄우기		
	//팝업창 오픈요청
function goGridPopOpen(tGrpId,tRowId,tColIndex,tValue,tText){
	alog("goGridPopOpen()............. tGrpId = " + tGrpId + ", tRowId = " + tRowId + ", tColIndex = " + tColIndex + ", tValue = " + tValue + ", tText = " + tText);
	
	//PGMGRP ,  	
	tColId = tColIndex;
	//G2, rst3, FILETYPE, FILETYPE
	if( tGrpId == "G2" && tColId == "FILETYPE" ){
		obj_G2_FILETYPE_POPUP = window.open("about:blank","codeSearch_G2_FILETYPE_Pop","width=800px,height=500px,resizable=yes,scrollbars=yes");
		
		//값세팅하고
		var frm1 = $('form[name="popupForm"]');

		frm1.append("<input type=text name='FILETYPE' id='FILETYPE' value='" + tValue + "'>");//이 컬럼이 동적으로 FILETYPE 변경되어야 함.	
		frm1.append("<input type=text name='FILETYPE-NM' id='FILETYPE-NM' value='" + tText + "'>");//이 컬럼이 동적으로 FILETYPE 변경되어야 함.	
		
		$("#GRPID").val(tGrpId);
		$("#ROWID").val(tRowId);		
		$("#COLID").val(tColId);

		//폼실행
		var frm =document.popupForm;
		frm.action = "pgmsearchwixView.php";//호출할 팝업 프로그램 URL
		frm.target = "codeSearch_G2_FILETYPE_Pop";
		frm.method = "post";
		//frm.submit();

		alog("delay end and go.");

		//딜레이 폼실행
		var timer;
		var delay = 500; // 0.6 seconds delay after last input
		window.clearTimeout(timer);
		timer = window.setTimeout(function(){
			alog("delay end and go1.");
			frm.submit();
			alog("delay end and go2.");
		}, delay);
	}
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
	//GRID
	if(tGrpId == "G2" && tColId =="FILETYPE"){
		alog("LAST_ROWID = " + tRowId);
		//그리드 일때
		var rowItem = $$("wixdtG2").getItem(tRowId);

		rowItem.FILETYPE = tJsonObj.CD + "^" + tJsonObj.NM;
		//rowItem.changeState = true; // fncDataUpdate 호출되기 때문에 불필요
		//rowItem.changeCud = "updated";

		$$("wixdtG2").updateItem(tRowId, rowItem);

		//$$("wixdtG2").addRowCss(tRowId, "fontStateUpdate");// fncDataUpdate 호출되기 때문에 불필요

		//팝업창 닫기
		if(obj_G2_FILETYPE_POPUP != null)obj_G2_FILETYPE_POPUP.close();
	}

}//popReturn
//그룹별 초기화 함수	
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");
	//각 폼 오브젝트들 초기화
  alog("G1_INIT()-------------------------end");
}

//rst3 그리드 초기화
function G2_INIT(){
	alog("G2_INIT()-------------------------start");

	$( window ).resize( function() {
		alog("G2 window resize.....................start");
		$$("wixdtG2").resize();
	});
	$("#G2-EDITMODE_EDIT_MODE").change(function(){
        if($("#G2-EDITMODE_EDIT_MODE").is(":checked")){
            $$("wixdtG2").config.editaction = "click";
        }else{
            $$("wixdtG2").config.editaction = "dblclick";
        }
	});

	$("#FILE_G2-ELOAD").on("change", function(e){
		alog("FILE_G2-ELOAD.change().................start");
		var files = e.target.files; //input file 객체를 가져온다.
		var i,f;
		for (i = 0; i != files.length; ++i) {
			f = files[i];
			var reader = new FileReader(); //FileReader를 생성한다.         

			//성공적으로 읽기 동작이 완료된 경우 실행되는 이벤트 핸들러를 설정한다.
			reader.onload = function(e) {

			   var data = e.target.result; //FileReader 결과 데이터(컨텐츠)를 가져온다.

			   //바이너리 형태로 엑셀파일을 읽는다.
			   var workbook = XLSX.read(data, {type: 'binary'});

			   //엑셀파일의 시트 정보를 읽어서 JSON 형태로 변환한다.
			   workbook.SheetNames.forEach(function(item, index, array) {
				   EXCEL_JSON = XLSX.utils.sheet_to_json(workbook.Sheets[item]);
				   alog(EXCEL_JSON);
				   $$("wixdtG2").parse(EXCEL_JSON, "json");

					$("#spanG2Cnt").text($$("wixdtG2").count());

				});//end. forEach

			}; //end onload

			//파일객체를 읽는다. 완료되면 원시 이진 데이터가 문자열로 포함됨.
			reader.readAsBinaryString(f);

		}//end. for
	
	});


	webix.ready(function(){

		webix.i18n.calendar = webixConfig.calendar;
		webix.i18n.dateFormat = webixConfig.dateFormat;
		webix.i18n.setLocale();
		webix.editors.$popup.text = webixConfig.popup_text;//팝업 가로/세로 커스텀

		// filter
		// 기본 : textFilter selectFilter numberFilter dateFilter 
		// 프로 : richSelectFilter multiSelectFilter multiComboFilter datepickerFilter dateRangeFilter excelFilter
		// datepickerFilter, dateRangeFilter : json은 리털밸류가 문자, 숫자만 있기 때문에 날짜인식을 위해서는 map을 이용해 (date)타입으로 변환필요
		//  기본 map 형식은 map: "(date)#colid1#"이나 id와 동일컬럼인 경우 "(date)" 날짜타입 변환만 표기 
		// multiSelectFilter : 선택전에는 콤보오브젝트 표시되고 선택후, 라벨에 선택된 아이템목록 모두 출력
		// multiComboFilter : 선택전에는 텍스트입력 오브젝트 표시되고 선택후, 라벨에 선택된 아이템수만 출력

		wixdtG2 = webix.ui({
			container: "wixdtG2",
			view: "datatable",
			//height:520, 
			//width:750,
			autowidth: true,
			scroll: true,
			editable: true,
			editaction: "dblclick",
			id: "wixdtG2",
			leftSplit: 0,
			select: "row", //cell, row, column, true, false
			hover: "myhover",
			resizeColumn:true,
			autoheight:false,
			autowidth:false,
			css: "webix_data_border webix_header_border webix_footer_border",
			columns:[
				{
					id:"RSTSEQ", sort:"int"
					, css:{"text-align":"LEFT"}
					, width:50
					, header:"RSTSEQ"
				},
				{
					id:"PJTSEQ", sort:"int"
					, css:{"text-align":"LEFT"}
				, hidden: true
					, width:50
					, header:"PJTSEQ"
				},
				{
					id:"PGMSEQ", sort:"string"
					, css:{"text-align":"RIGHT"}
					, width:50
					, header:"PGMSEQ"
					, template:function(obj){
						//alog("link1.template().............................start");
						//alog(this);
						//alog(obj);
						t=obj.PGMSEQ + ""; //형식 nm^link^target (정렬시 nm이 먼저활용되게 하기 위함)
						if(t.indexOf("^") >= 0){
							tNm = t.split("^")[0];
							tLink = t.split("^")[1];
							tTarget = t.split("^")[2];
						}else{
							tNm = t;
							tLink = "";
							tTarget = "_blank";
						}

						var rtnVal = "<div style='float:RIGHT;'><a href='" + tLink + "' target='" + tTarget + "'>" + tNm + "</a></div>";
						return rtnVal;
					}
				},
				{
					id:"FILETYPE", sort:"string"
					, css:{"text-align":"LEFT"}
					, width:100
					, header:"FILETYPE"
					, template:function(obj){
						//alog("codesearch.template().............................start");
						//alog(this);
						//alog(obj);
						t=obj.FILETYPE + ""; //형식 nm^cd (정렬시 nm이 먼저활용되게 하기 위함)
						if(t.indexOf("^") >= 0){
							tCd = t.split("^")[1];
							tNm = t.split("^")[0];
						}else{
							tCd = t;
							tNm = t;
						}

						grpId = "G2"; //rst3
						dataId = obj.id;
						colId = this.id;
						var rtnVal = "<div style='float:left;' id='" + tCd + "'>" + tNm + "</div>";
						rtnVal += "<div style='float:right;'>";
						rtnVal += "<img style='margin-bottom:2px;' height=21 width=21  onMouseOver=\"this.style.cursor='pointer'\" onclick=\"goGridPopOpen('" + grpId + "','" + dataId + "','" + colId + "','" +  tNm + "','" + tCd + "',this)\" src='http://localhost:8070/img/search.png'>";
						rtnVal += "</div>";
						return rtnVal
					}
				},
				{
					id:"VERSEQ", sort:"int"
					, css:{"text-align":"LEFT"}
					, width:60
					, header:"VERSEQ"
					, editor:"text"
				},
				{
					id:"SRCORD", sort:"string"
					, css:{"text-align":"LEFT"}
					, width:100
					, header:"ORD"
				},
				{
					id:"SRCTXT", sort:"string"
					, css:{"text-align":"LEFT"}
					, fillspace: true
					, header:["TXT", {content:"textFilter"}]
					, editor:"popup"
					, template:function(obj){
						return _.replace(_.replace(obj.SRCTXT,/</g,"&lt;"),/>/g,"&gt;");
					}
				},
				{
					id:"ADDDT", sort:"string"
					, css:{"text-align":"LEFT"}
					, width:200
					, header:"생성일"
				},
				{
					id:"MODDT", sort:"string"
					, css:{"text-align":"LEFT"}
					, width:60
					, header:"MODDT"
				},
			]
			, on:{
				onSelectChange:function(){
					var text = "Selected: "+$$("wixdtG2").getSelectedId(true).join();
					console.log(text);
				},
				onAfterSelect:function(){  logEvent("select:after","Cell selected",arguments);  },
				//onCheck:function(){  logEvent("check","Checkbox",arguments);  },
				onAfterEditStart:function(){  logEvent("edit:afterStart","Editing started",arguments);  },
				onAfterEditStop: fncAfterEditStop,
			}
			//url:"demo_webix_data.php"
		}); //datetable create end
		wixdtG2.attachEvent("onItemClick", function(cellData, e, htmlObj){
			alog("onItemClick()............................start");
			alog(cellData);
			//alog(e);
			//alog(htmlObj);

			var rowId = cellData.row;
			var rowData = $$("wixdtG2").data.getItem(rowId);
			//alert($$("webix_dt").getFilter("start").value);
		});
		wixdtG2.attachEvent("onBeforeFilter", fncBeforeFilter);
		wixdtG2.data.attachEvent("onDataUpdate", fncDataUpdate);
		wixdtG2.data.attachEvent("onIdChange", fncIdChange);

	});//webix.ready end
	alog("G2_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //rst3
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//, S	
function G1_SAVEA(token){
 alog("G1_SAVEA-------------------start");
	//FormData parameter에 담아줌	
	sendFormData = new FormData($("#condition")[0]);	//G1 getparams	
	allData = $$("wixdtG2").serialize(true);
	//alog(allData);
	var myJsonString = JSON.stringify(_.filter(allData,['changeState',true]));
	sendFormData.append("G2-JSON",myJsonString);
	$.ajax({
		type : "POST",
		url : url_G1_SAVEA+"&TOKEN=" + token ,
		data : sendFormData,
		processData: false,
		contentType: false,
		async: false,
		dataType: "json",
		success: function(data){
			alog("   json return----------------------");
			alog(data);
			//data = jQuery.parseJSON(tdata);
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
	alog("G1_SAVEA-------------------end");	
}
//사용자정의함수 : 경고
function G2_UDEF(token){
	alog("G2_UDEF-----------------start");
alert('userdef');


	alog("G2_UDEF-----------------end");
}
//그리드 조회(rst3)
function G2_DOWN(tinput,token){
	alog("G2_DOWN()------------start");

	webix.toExcel($$("wixdtG2"),{
		filterHTML:true //HTML제거하기 ( 제거안하면 템플릿 html이 모두 출력됨 )
		, columns : {
			"RSTSEQ": {header: "RSTSEQ"}
,			"PJTSEQ": {header: "PJTSEQ"}
,			"PGMSEQ": {header: "PGMSEQ"}
,			"FILETYPE": {header: "FILETYPE"}
,			"VERSEQ": {header: "VERSEQ"}
,			"SRCORD": {header: "SRCORD"}
,			"SRCTXT": {header: "SRCTXT"}
,			"ADDDT": {header: "ADDDT"}
,			"MODDT": {header: "MODDT"}
			}
		}   
	);


	alog("G2_DOWN()------------end");
}//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
//그리드 조회(rst3)	
function G2_SEARCH(tinput,token){
	alog("G2_SEARCH()------------start");

    $$("wixdtG2").clearAll();
	//get 만들기
	sendFormData = new FormData();//빈 formdata만들기
	var conAllData = $( "#condition" ).serialize();
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
					$$("wixdtG2").parse(data.RTN_DATA.rows,"json");
					var afterDate = new Date();
					alog("	parse render time(ms) = " + (afterDate - beforeDate));

			}else{
				$("#spanG2Cnt").text("-");
			}
			msgNotice("[rst3] 조회 성공했습니다. ("+row_cnt+"건)",1);

			}else{
				msgError("[rst3] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
			}
		},
		error: function(error){
			msgError("[rst3] Ajax http 500 error ( " + error + " )",3);
			alog("[rst3] Ajax http 500 error ( " + data.RTN_MSG + " )");
		}
	});
        alog("G2_SEARCH()------------end");
    }

//rst3
function G2_SV(token){
	alog("G2_SV()------------start");

    allData = $$("wixdtG2").serialize(true);
    //alog(allData);
    var myJsonString = JSON.stringify(_.filter(allData,['changeState',true]));        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		var conAllData = "";
	//상속받은거 전달할수 있게 합치기
	if(typeof lastinputG2 != "undefined" && lastinputG2 != null){
		var tKeys = lastinputG2.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],lastinputG2.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ lastinputG2.get(tKeys[i])); 
		}
	}
	sendFormData.append("G2-JSON" , myJsonString);
	allData = $$("wixdtG2").serialize(true);
	//alog(allData);
	var myJsonString = JSON.stringify(_.filter(allData,['changeState',true]));
	sendFormData.append("G2-JSON",myJsonString);

	$.ajax({
		type : "POST",
		url : url_G2_SV+"&TOKEN=" + token + "&" + conAllData ,
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
	
	alog("G2_SV()------------end");
}
//사용자정의함수 : H
function G2_HDNCOL(token){
	alog("G2_HDNCOL-----------------start");

	if(isToggleHiddenColG2){
		$$("wixdtG2").hideColumn("PJTSEQ");
		isToggleHiddenColG2 = false;
	}else{
		$$("wixdtG2").showColumn("PJTSEQ");
			isToggleHiddenColG2 = true;
		}

		alog("G2_HDNCOL-----------------end");
	}
