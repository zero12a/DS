var grpInfo = new HashMap();
grpInfo.set(
	"G1", 
		{
			"GRPTYPE": "CONDITION"
			,"GRPNM": ""
		}
); //
grpInfo.set(
	"G2", 
		{
			"GRPTYPE": "GRIDJQX"
			,"GRPNM": "그리드JQX"
		}
); //그리드JQX
//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "jqxgridController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "jqxgridController?CTLGRP=G1&CTLFNC=RESET";
// 변수 선언	
var obj_G1_PGMID; // 프로그램ID 변수선언
var obj_G2__POPUP = null;//  글로벌 변수 선언 - 팝업
//컨트롤러 경로
var url_G2_SEARCH = "jqxgridController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "jqxgridController?CTLGRP=G2&CTLFNC=SAVE";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json, dataAdapterG2;
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
	
	tColId = mygridG2.getColumnId(tColIndex);
	
	//PGMGRP ,  	
}
function goFormPopOpen(tGrpId, tColId, tColId_Nm){
	alog("goFormviewPopOpen()............. tGrpId = " + tGrpId + ", tColId = " + tColId + ", tColId_Nm = " +tColId_Nm );
	
	tColId_Val = $("#" + tColId).val();
	tColId_Nm_Text = $("#" + tColId_Nm).text();
	//PGMGRP ,  	
	//G1, , PGMID, 프로그램ID
	if( tGrpId == "G1" && tColId == "G1-PGMID" ){
		obj_G1_PGMID_POPUP = window.open("about:blank","codeSearch_G1_PGMID_Pop","width=,height=,resizable=yes,scrollbars=yes");
		
		//값세팅하고
		var frm1 = $('form[name="popupForm"]');

		frm1.append("<input type=text name='PGMID' id='PGMID' value='" + tColId_Val + "'>");//이 컬럼이 동적으로 PGMID 변경되어야 함.	
		frm1.append("<input type=text name='PGMID-NM' id='PGMID-NM' value='" + tColId_Nm_Text + "'>");//이 컬럼이 동적으로 PGMID 변경되어야 함.		

		$("#GRPID").val(tGrpId);
		$("#COLID").val(tColId);

		//폼실행
		var frm =document.popupForm;
		frm.action = "";//호출할 팝업 프로그램 URL
		frm.target = "codeSearch_G1_PGMID_Pop";
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

}// goFormviewPopOpen
//부모창 리턴용//팝업창에서 받을 내용
function popReturn(tGrpId,tRowId,tColId,tBtnNm,tJsonObj){
	//alert("popReturn");
		//, 
	//FORM
	if(tGrpId == "G1" && tColId =="G1-PGMID"){
		$("#G1-PGMID").val(tJsonObj.CD);
		$("#G1-PGMID-NM").text(tJsonObj.NM);

		//팝업창 닫기
		if(obj_G1_PGMID_POPUP != null) obj_G1_PGMID_POPUP.close();
	}

}//popReturn
//그룹별 초기화 함수	
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");
	//각 폼 오브젝트들 초기화
	//PGMID, 프로그램ID 초기화	
  alog("G1_INIT()-------------------------end");
}

//그리드JQX 그리드 초기화
function G2_INIT(){
	alog("G2_INIT()-------------------------start");

	jqx.credits = '75CE8878-FCD1-4EC7-9249-BA0F153A5DE8';
//##################################################################
//##    커스텀 렌더러(콤보, 다랍다운)
//##################################################################
//##################################################################
//##    필터 데이터 로드(이건 화면 렌더링 시에 필요하기 때문에 렌더링전에 데이터가 준비되어야해서, 동기식으로 데이터 로딩필요)
//##################################################################
//##################################################################
//##    컬럼 데이터 및 오브젝트
//##################################################################
//##################################################################
//##   필터 정의
//##################################################################
//그리드JQX
var gridFilterG2 = function(cellValue, rowData, dataField, filterGroup, defaultFilterResult){
//alog("gridFilter().....................................start : dataField=" + dataField + ", cellValue="+cellValue);
}//그리드JQX filter end
        //filter type
        //   'textbox' - basic text field.
         //    'input' - input field with dropdownlist for choosing the filter condition. *Only when "showfilterrow" is true.
        //     'checkedlist' - dropdownlist with checkboxes that specify which records should be visible and hidden.
        //     'list' - dropdownlist which specifies the visible records depending on the selection.
        //     'number' - numeric input field. *Only when "showfilterrow" is true.
        //     'bool' - filter for boolean data. *Only when "showfilterrow" is true.
         //    'date' - filter for dates.

        // initialize jqxGrid
        $("#jqxgridG2").jqxGrid(
        {
            ready: function(){},
            filter: gridFilterG2,
            width: 800,
            localization: getLocalization(),
            //autoshowloadelement: true,
            //source: dataAdapterGrid,    
            columnsheight: 26, //헤더 높이 default 32
            filterrowheight: 37, //필터 높이 default 37 (jqxgrid.filter.js 에 input필드 인라인으로 margin 4px가 하드코딩 됨.ㅠㅠ)
            rowsheight: 26, //데이터의행 높이
            height: 300,            
            pageable: false,
            autoheight: false,
            sortable: true,
            altrows: true,
            enabletooltips: true,
            editable: true,
            showfilterrow: false,
            filterable: false,
            editmode: 'dblclick', //click, dblclick, selectedcell, selectedrow
            columnsresize: true,
            selectionmode: 'checkbox', //'none', 'singlerow', 'multiplerows', 'multiplerowsextended', 
            columns: [
				{ cellclassname: cellclass, text: 'PGMSEQ'
				, datafield: 'PGMSEQ', width: 200
				, cellsalign: 'LEFT', align: 'LEFT'
				, columntype: 'TEXTBOX'
				},
				{ cellclassname: cellclass, text: '프로그램ID'
				, datafield: 'PGMID', width: 100
				, cellsalign: 'LEFT', align: 'LEFT'
				, columntype: 'TEXTBOX'
				},
				{ cellclassname: cellclass, text: '프로그램이름'
				, datafield: 'PGMNM', width: 100
				, cellsalign: 'LEFT', align: 'LEFT'
				, columntype: 'TEXTBOX'
				},
            ]
        });
  alog("G2_INIT()-------------------------end");
}//D146 그룹별 기능 함수 출력		
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
			lastinputG2 = new HashMap(); //그리드JQX
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//그리드JQX
function G2_SAVE(token){
	alog("G2_SAVE()------------start");


	var rows = $('#jqxgridG2').jqxGrid('getrows');
	var myJsonString = JSON.stringify(_.filter(rows,['changeState',true])); //loadash.js  (find는 1개만 찾고, filter를 모두 찾아줌)
		//get 만들기
		sendFormData = new FormData();//빈 formdata만들기
		var conAllData = $( "#condition" ).serialize();
        //post 만들기
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

	$.ajax({
		type : "POST",
		url : url_G2_SAVE+"&TOKEN=" + token + "&" + conAllData ,
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
//그리드 조회(그리드JQX)	
function G2_SEARCH(tinput,token){
	alog("G2_SEARCH()------------start");
//##################################################################
//##    그리드 데이터 로드
//##################################################################
        var sourceG2 =
        {
            datatype: "json",
            async: true,
            datafields: [
                { name: 'PGMSEQ', type: 'NUMBER', format: '' },
                { name: 'PGMID', type: 'STRING', format: '' },
                { name: 'PGMNM', type: 'STRING', format: '' },
            ],
            root: "RTN_DATA>rows",
            //record: "JQXGRID",
            id: 'PGMSEQ',
            url: "JQXGRIDController?CTLGRP=G2&CTLFNC=SEARCH"
        };

        dataAdapterG2 = new $.jqx.dataAdapter(sourceG2, {
            autobind: false,
            downloadComplete: function (data, status, xhr) { },
            loadComplete: function (data) { },
            loadError: function (xhr, status, error) { },
            updaterow: function (rowIndex, rowdata, commit) {
                alog("dataAdapterGrid updaterow()...................start");
                alog(rowdata);

                commit(true);

                //기본이 변경
                rowdata.changeState = true;

                //변경과 삭제가 동일하게 updaterow이벤트 사용하기 때문에 주의 요망
                if(typeof rowdata.changeCud == "undefined" || rowdata.changeCud == ""){
                    rowdata.changeCud = "updated";
                }
                                
            },
            addrow: function (rowIndex, rowdata, position, commit) {
                alog("dataAdapterGrid addrow()...................start");                    
                //alog("  rowIndex = " + rowIndex);

                commit(true);

                rowdata.changeState = true;
                rowdata.changeCud = "inserted";
                //alog(this);
            },
            deleterow: function (rowIndex, commit) {
                alog("dataAdapterGrid deleterow()...................start");      
                alog("  rowIndex = " + rowIndex);    
       
                commit(true);
            }                
        });
	$("#jqxgridG2").jqxGrid({
		source: dataAdapterG2
	});
	alog("G2_SEARCH()------------end");
}
