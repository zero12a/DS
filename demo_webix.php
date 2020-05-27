<?php
header("Content-Type: text/html; charset=UTF-8");

//redis에 모두 넣기
//require_once "/data/www/lib/php/vendor/autoload.php";
$CFG = require_once("../common/include/incConfig.php");

?><!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>webix</title>
    <meta name="description" content="JavaScript Grid with rich support for Data Filtering, Paging, Editing, Sorting and Grouping" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link rel="stylesheet" hr ef="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/webix/codebase/webix.min.css" type="text/css" charset="utf-8">

    <link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/webix/codebase/skins/mini.min.css" type="text/css" charset="utf-8">
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/webix/codebase/webix.js" type="text/javascript" charset="utf-8"></script>

    

    <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js"></script>

	<style type="text/css">
        .myhover{
            background: #F0DCB6;
        }

        .fontStateInsert{
            text-decoration: none;
            font-weight: bold;
            color: darkblue;
        }

        .fontStateUpdate{
            text-decoration: none;
            font-weight: bold;
            color: black;
        }

        .fontStateDelete{
            text-decoration: line-through;
            font-weight: bold;
            color: black;
        }

        .fontNormal{
            text-decoration: none;
            font-weight: normal;
        }

        .highlight{
            background-color:#FFAAAA;
        }
        /* even odd 
        https://forum.webix.com/discussion/2395/alternating-styles-for-even-and-odd-rows

        .webix_column > div:nth-child(2n) {
            background-color: #F7F7F7;
        }
        .webix_column > div.webix_cell_select:nth-child(2n), .webix_column > div.webix_column_select:nth-child(2n), .webix_column > div.webix_row_select:nth-child(2n) {
            color: #fff;
            background: #27ae60;
        }
        */
    </style>
</head>
<body>
<input type=button onclick="isMasterChecked()" value="isMasterChecked?">
<input type=button onclick="grida.add({},0)" value="addRow">
<input type=button onclick="loadData()" value="loadData">
<input type=button onclick="getChangedData()" value="getChangedData">
<input type=button onclick="getAllData()" value="getAllData">
<input type=button onclick="addRow()" value="addRow">
<input type=button onclick="delRow()" value="delRow">
<input type=button onclick="saveOk()" value="saveOk">
<input type=button onclick="removeOk()" value="removeOk">
<input type=button onclick="changeId(99999)" value="changeId(99999)">
<input type=button onclick="getSelectedItem()" value="getSelectedItem">
<div id="testA"></div>
</body>
<script>
function getSelectedItem(){
    alog("getSelectedItem()...........................start");
    rowId = $$("webix_dt").getSelectedId(false);
    alog("  rowId=" + rowId);
    var rowItem1 = $$("webix_dt").getItem(rowId);
    alog("rowItem = " + JSON.stringify(rowItem1));
}
function changeId(tmp){
    alog("changeId()...........................start");
    // https://snippet.webix.com/2d8d744c
    // https://forum.webix.com/discussion/31269/update-the-id-in-datatable
    var rowId = $$("webix_dt").getSelectedId(false);
    if(typeof rowId != "undefined" && rowId != null){
        //$$("webix_dt").data.changeId(rowId,tmp);

        var rowItem1 = $$("webix_dt").getItem(rowId);
        alog("old rowItem = " + JSON.stringify(rowItem1));

        //$$("webix_dt").data.changeId(rowId,tmp);  
        rowItem1.id = tmp;
        //$$("webix_dt").data.updateItem(rowId, rowItem1);
        $$("webix_dt").updateItem(rowId, rowItem1);
        //$$("webix_dt").data.changeId(rowId,tmp);  

        var rowItem2 = $$("webix_dt").getItem(rowId);
        alog("new rowItem = " + JSON.stringify(rowItem2));

        $$("webix_dt").refresh();
    }
}
function removeOk(){
    alog("removeOk()...........................start");
    rowId = $$("webix_dt").getSelectedId(false);

    $$("webix_dt").remove(rowId); // removes the item with ID=1
}
function saveOk(){
    alog("saveOk()...........................start");
    rowId = $$("webix_dt").getSelectedId(false);

    $$("webix_dt").removeRowCss(rowId, "fontStateUpdate");
    $$("webix_dt").removeRowCss(rowId, "fontStateDelete");
    $$("webix_dt").removeRowCss(rowId, "fontStateInsert");
    
    rowItem = $$("webix_dt").getItem(rowId);
    rowItem.changeState = null;
    rowItem.changeCud = "";
}

function check(){
    $$("dt").getHeaderContent("mc1").check();
};
function uncheck(){
    $$("dt").getHeaderContent("mc1").uncheck();
};
function isMasterChecked(){
    var state = $$("dt").getHeaderContent("mc1").isChecked();
    webix.message(state?"checked":"unchecked");
};


function delRow(){
    rowId = $$("webix_dt").getSelectedId(false);
    alog(rowId);
    if(typeof rowId != "undefined"){
        $$("webix_dt").addRowCss(rowId, "fontStateDelete");

        rowItem = $$("webix_dt").getItem(rowId);
        rowItem.changeState = true;
        rowItem.changeCud = "deleted";
    }else{
        alert("삭제할 행을 선택하세요.");
    }
}

function addRow(){
    rowId = $$("webix_dt").add({
        id: webix.uid(),
        title: "제목입니다.",
        year: "1980",
        votes: 1000,
        rank:5,
        start:"2020-10-10",
        popup:"good",
        combo1: "1978"
    },0);

    $$("webix_dt").addRowCss(rowId, "fontStateInsert");
    alog("add row rowId : " + rowId);
    rowItem = $$("webix_dt").getItem(rowId);
    rowItem.changeState = true;
    rowItem.changeCud = "inserted";
}
function getChangedData(){
    allData = $$("webix_dt").serialize(true);
    alog(allData);
    chgData = _.filter(allData,['changeState',true]);

    alog(chgData);
}

function getAllData(){
    const allData = $$("webix_dt").serialize(true);
    alog(allData);
    //alert(allData);
}

function loadData(){
    $$("webix_dt").clearAll();
    $$("webix_dt").load("demo_webix_data.php");
    alog(atob("d2ViaXguY29tLw=="));
    alog(atob("d2ViaXhjb2RlLmNvbS8="));
    alog(atob("VGhpcyB2ZXJzaW9uIG9mIFdlYml4IGlzIG5vdCBpbnRlbmRlZCBmb3IgdXNpbmcgb3V0c2lkZSBvZiB3ZWJpeC5jb20="));
}

function logEvent(type, message, args){
    webix.message({ text:message, expire:1500 });
    console.log(type);
    console.log(args);
};

webix.ready(function(){


    webix.i18n.calendar = {
        monthFull:["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        monthShort:["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        dayFull:["일", "월", "화", "수", "목", "금", "토"],
        dayShort:["일", "월", "화", "수", "목", "금", "토"],
        hours: "시",
        minutes: "분",
        done:"확인",
        clear: "지우기",
        today: "오늘"
    };
    webix.i18n.dateFormat = "%Y-%m-%d";
    webix.i18n.timeFormat = "%H:%i";
    webix.i18n.longDateFormat = "%Y-%m-%d";
    webix.i18n.fullDateFormat = "%Y-%m-%d %H:%i:%s";
    webix.i18n.setLocale();


    var years = [];
    for (var i = 1970; i < 2200; i++)years.push({ id:i, value: i+"년" });
    
    const years2 = new webix.DataCollection({
        data: function(){
            var tyears = [];
            for (var i = 1970; i < 2200; i++)tyears.push({ id:i, value: i+"년" });
            return tyears;
        }
    });

    const ranks = new webix.DataCollection({
        data:[
                { "id":1,"value":"1등" },
                { "id":2,"value":"2등" },
                { "id":3,"value":"3등" },
                { "id":4,"value":"4등" },
                { "id":5,"value":"5등" },
            ]
    });

    // filter
    // 기본 : textFilter selectFilter numberFilter dateFilter 
    // 프로 : richSelectFilter multiSelectFilter multiComboFilter datepickerFilter dateRangeFilter excelFilter
    // datepickerFilter, dateRangeFilter : json은 리털밸류가 문자, 숫자만 있기 때문에 날짜인식을 위해서는 map을 이용해 (date)타입으로 변환필요
    //  기본 map 형식은 map: "(date)#colid1#"이나 id와 동일컬럼인 경우 "(date)" 날짜타입 변환만 표기 
    // multiSelectFilter : 선택전에는 콤보오브젝트 표시되고 선택후, 라벨에 선택된 아이템목록 모두 출력
    // multiComboFilter : 선택전에는 텍스트입력 오브젝트 표시되고 선택후, 라벨에 선택된 아이템수만 출력

    grida = webix.ui({
        container:"testA",
        view:"datatable",
        height:520, 
        width:750,
        scroll:true,
        editable:true,
        editaction:"dblclick",
        id:"webix_dt",
        leftSplit:2,
        select:"row", //cell, row, column, true, false
        hover:"myhover",
        css:"webix_data_border webix_header_border webix_footer_border",
        columns:[
            { id:"ch1", header:{ content:"masterCheckbox", contentId:"mc1" }, checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:40},
            { editor:"select", options:ranks,		id:"rank",	header:"rank", css:"rank",  		width:50, sort:"int"},
            { editor:"text",	id:"title",	header:"Film title",    width:100, sort:"string"},
            { editor:"multiselect",	id:"year",
                optionslist: true,
                options: years,
                header: ["Released",{content:"multiSelectFilter"}] ,     
                width: 120, 
                sort:"string"},
            { editor:"text",	id:"votes",	header:"Votes", 	width:100, sort:"int", numberFormat:"1,111.00"},
            { editor:"date",	id:"start",	header:["start", {content:"dateRangeFilter"}], 	width:100, sort:"date"
                //, format:webix.i18n.dateFormatStr
                , format:webix.Date.dateToStr("%Y-%m-%d")
                , map: "(date)"
            },
            { editor:"popup",	id:"popup",	header:["popup", {content:"textFilter"}], 	width:100, sort:"string"},
            { editor:"combo",	id:"combo1",	header:["combo1", {content:"selectFilter"}], 	width:100, sort:"int", collection:years}
        ],
        resizeColumn:true,
        autoheight:false,
        autowidth:false,
        on:{
            onSelectChange:function(){
                var text = "Selected: "+grida.getSelectedId(true).join();
                console.log(text);
            },
            onItemClick:function(){logEvent("click","Cell clicked",arguments);  },
            onAfterSelect:function(){  logEvent("select:after","Cell selected",arguments);  },
            //onCheck:function(){  logEvent("check","Checkbox",arguments);  },
            onAfterEditStart:function(){  logEvent("edit:afterStart","Editing started",arguments);  },
            onAfterEditStop:function(state, editor, ignoreUpdate){
                alog("onAfterEditStop()................................start");
                alog(state);
                alog(editor);
                alog(ignoreUpdate);
                
                if(state.value != state.old){
                    webix.message("Cell value " + editor.row + " was changed");

                }  

            },
		},
        //url:"demo_webix_data.php"
    });	

    grida.attachEvent("onBeforeFilter", function(id, value, config){
        alog("onBeforeFilter()............................start");
        alog(id);
        alog(value);

        alog(config);

        //alert($$("webix_dt").getFilter("start").value);
    });

    grida.data.attachEvent("onDataUpdate", function(id, newObj, oldObj){
        alog("onDataUpdate()............................start");
        alog(id);
        alog(newObj);
        if(typeof newObj.changeState == "undefined" || newObj.changeState == null){
            $$("webix_dt").addRowCss(id, "fontStateUpdate");
            newObj.changeState = true;
            newObj.changeCud = "updated";
        }

        alog(oldObj);
        alog("onDataUpdate()............................end");
    });

});


function alog(tmp){
    if(console)console.log(tmp);
}
</script>
</html>