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

    <link rel="stylesheet" href="https://cdn.webix.com/site/webix.css?v=7.3.3" type="text/css" charset="utf-8">
    <script src="https://cdn.webix.com/site/webix.js?v=7.3.3" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js"></script>

	<style type="text/css">
        .myhover{
            background: #F0DCB6;
        }

        .fontBold, .fontBold span {
            font-weight: bold;
        }

        .fontLineThrough, .fontLineThrough span {
            text-decoration: line-through;
            font-weight: bold;
        }

        .fontNormal, .fontNormal span {
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
<div id="testA"></div>
</body>
<script>
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
        $$("webix_dt").addRowCss(rowId, "fontLineThrough");

        rowItem = $$("webix_dt").getItem(rowId);
        rowItem.changeState = true;
        rowItem.changeCud = "deleted";
    }else{
        alert("삭제할 행을 선택하세요.");
    }
}

function addRow(){
    rowId = $$("webix_dt").add({
        id: "0000good",
        title: "제목입니다.",
        year: "1980",
        votes: 1000,
        rank:5,
        start:"2020-10-10",
        popup:"good",
        combo1: "1978"
    },0);

    $$("webix_dt").addRowCss(rowId, "fontBold");

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
    $$("webix_dt").load("demo_webix_data.php");
}

function logEvent(type, message, args){
    webix.message({ text:message, expire:2500 });
    console.log(type);
    console.log(args);
};

webix.ready(function(){


    webix.i18n.calendar = {
        monthFull:["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        monthShort:["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        dayFull:["일", "월", "화", "수", "목", "금", "토"],
        dayShort:["일", "월", "화", "수", "목", "금", "토"]
    };
    webix.i18n.calendar.clear = "지우기";
    webix.i18n.calendar.today = "오늘";
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
        select:"row",
        hover:"myhover",
        css:"webix_data_border webix_header_border webix_footer_border",
        columns:[
            { id:"ch1", header:{ content:"masterCheckbox", contentId:"mc1" }, checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:40},
            { editor:"select", options:ranks,		id:"rank",	header:"", css:"rank",  		width:50, sort:"int"},
            { editor:"text",	id:"title",	header:"Film title",    width:200, sort:"string"},
            { editor:"multiselect",	id:"year",
                optionslist:true,
                options:years,	header:"Released" ,     width:80, sort:"string"},
            { editor:"text",	id:"votes",	header:"Votes", 	width:100, sort:"int", numberFormat:"1,111.00"},
            { editor:"date",	id:"start",	header:"start", 	width:100, sort:"date", format:webix.Date.dateToStr("%Y-%m-%d")},
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
            onItemClick:function(){  logEvent("click","Cell clicked",arguments);  },
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

    
    grida.data.attachEvent("onDataUpdate", function(id, newObj, oldObj){
        alog("onDataUpdate()............................start");
        alog(id);
        alog(newObj);
        if(typeof newObj.changeState == "undefined"){
            $$("webix_dt").addRowCss(id, "fontBold");
            newObj.changeState = true;
            newObj.changeCud = "updated";
        }

        alog(oldObj);
    });

});


function alog(tmp){
    if(console)console.log(tmp);
}
</script>
</html>